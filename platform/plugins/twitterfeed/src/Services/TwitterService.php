<?php

namespace Obii\Twitterfeed\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TwitterService
{
    protected $client;
    protected $apiUrl = 'https://api.twitter.com/2';
    protected $bearerToken;
    protected $userId;

    public function __construct()
    {
        // Thay thế bằng Bearer Token của bạn
        $this->bearerToken = env('TWITTER_BEARER_TOKEN');
        $this->userId = env('TWITTER_USER_ID');
        $this->client = new Client();
    }

    /**
     * Lấy thông tin tài khoản Twitter của một người dùng bằng username.
     * 
     * @param string $username
     * @return array|null
     */
    public function getUserInfoByUsername($username)
    {
        try {
            // Lấy user_id từ username
            $response = $this->client->get("{$this->apiUrl}/users/by/username/{$username}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->bearerToken,
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            // Trả về thông tin người dùng
            return $data['data'] ?? null;
        } catch (RequestException $e) {
            // Xử lý lỗi nếu có
            return null;
        }
    }

    /**
     * Lấy danh sách bài post (tweets) từ username bằng Recent Search.
     * 
     * @param string $username
     * @param int $limit
     * @return array|null
     */
    public function getTweetsByUsername($username, $limit = 10)
    {
        try {
            $tweets = Cache::remember("tweets_{$username}", 900, function () use ($username, $limit) {
                $url = "{$this->apiUrl}/tweets/search/recent";
                $response = $this->client->get($url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->bearerToken,
                    ],
                    'query' => [
                        'query' => "from:{$username}",
                        'max_results' => $limit,
                        'tweet.fields' => 'created_at,text,attachments,referenced_tweets',
                        'expansions' => 'referenced_tweets.id,author_id,attachments.media_keys',
                        'media.fields' => 'url,preview_image_url,type',
                        'user.fields' => 'name,username,url',
                    ]
                ]);

                $data = json_decode($response->getBody()->getContents(), true);
                return $data;
            });
            return $this->formatTweets($tweets);
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    private function getRetweetUsers($tweetId)
    {
        $cacheKey = "retweets_{$tweetId}";
        // Cache dữ liệu trong 1 giờ
        $retweeters = Cache::remember($cacheKey, 3600, function () use ($tweetId) {
            $retweeters = [];
            $nextToken = null;

            do {
                $url = "https://api.twitter.com/2/tweets/{$tweetId}/retweeted_by";
                $params = [
                    'tweet.fields' => 'author_id',
                    'user.fields' => 'name,username',
                ];

                if ($nextToken) {
                    $params['pagination_token'] = $nextToken;
                }

                try {
                    $response = $this->client->get($url, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $this->bearerToken,
                        ],
                        'query' => $params
                    ]);

                    // Kiểm tra rate limit và xử lý nếu cần
                    $this->handleRateLimit($response);

                    $data = json_decode($response->getBody()->getContents(), true);

                    // Thêm các người dùng retweeted vào mảng
                    if (isset($data['data'])) {
                        $retweeters = array_merge($retweeters, $data['data']);
                    }

                    // Lấy token để phân trang tiếp theo
                    $nextToken = $data['meta']['next_token'] ?? null;
                } catch (RequestException $e) {
                    // Xử lý lỗi khi không thể kết nối với API
                    Log::error("Twitter API Error: " . $e->getMessage());
                    break;
                }
            } while ($nextToken); // Tiếp tục nếu còn trang tiếp theo

            return $retweeters;
        });

        return $retweeters;
    }



    /**
     * Format dữ liệu trả về từ Twitter API.
     * 
     * @param array $data
     * @return array|null
     */
    private function formatTweets(array $data)
    {
        if (!isset($data['data'])) {
            return null;
        }

        $tweets = $data['data'];
        $referencedTweets = collect($data['includes']['tweets'] ?? []);
        $users = collect($data['includes']['users'] ?? []);
        $media = collect($data['includes']['media'] ?? []);

        foreach ($tweets as &$tweet) {
            // Add media
            $tweet['media'] = [];
            if (isset($tweet['attachments']['media_keys'])) {
                foreach ($tweet['attachments']['media_keys'] as $mediaKey) {
                    $mediaItem = $media->firstWhere('media_key', $mediaKey);
                    if ($mediaItem) {
                        $tweet['media'][] = [
                            'url' => $mediaItem['url'] ?? null,
                            'preview_image_url' => $mediaItem['preview_image_url'] ?? null,
                            'type' => $mediaItem['type'] ?? 'unknown',
                        ];
                    }
                }
            }

            // Add referenced tweet content (for retweets, quoted tweets)
            if (isset($tweet['referenced_tweets'])) {
                foreach ($tweet['referenced_tweets'] as $ref) {
                    $refTweet = $referencedTweets->firstWhere('id', $ref['id']);
                    if ($refTweet) {
                        $tweet['full_text'] = $refTweet['text'];

                        // Add media from referenced tweet
                        if (isset($refTweet['attachments']['media_keys'])) {
                            foreach ($refTweet['attachments']['media_keys'] as $mediaKey) {
                                $mediaItem = $media->firstWhere('media_key', $mediaKey);
                                if ($mediaItem) {
                                    $tweet['media'][] = [
                                        'url' => $mediaItem['url'] ?? null,
                                        'preview_image_url' => $mediaItem['preview_image_url'] ?? null,
                                        'type' => $mediaItem['type'] ?? 'unknown',
                                    ];
                                }
                            }
                        }

                        // Add URL of the referenced tweet (Retweeted tweet URL)
                        $tweet['referenced_tweet_url'] = "https://x.com/{$refTweet['author_id']}/status/{$refTweet['id']}";
                    }
                }
            } else {
                $tweet['full_text'] = $tweet['text'];
            }

            // Add user info to the tweet
            $author = $users->firstWhere('id', $tweet['author_id']);
            if ($author) {
                $tweet['user_name'] = $author['name'];
                $tweet['user_username'] = $author['username'];
                $tweet['user_url'] = 'https://x.com/' . $author['username']; // URL of the user profile
                $tweet['tweet_url'] = "https://x.com/{$author['username']}/status/{$tweet['id']}";
            }

            // Process hashtags and URLs in the tweet text
            $tweet['full_text'] = $this->processHashtagsAndUrls($tweet['full_text']);

            // Fetch retweet users (users who retweeted the tweet)
            // $retweeters = $this->getRetweetUsers($tweet['id']);
            // $tweet['retweeters'] = $retweeters ?? []; // Add retweeters to the tweet

        }

        return $tweets;
    }

    /**
     * Process hashtags and URLs in the tweet text to make them clickable.
     * 
     * @param string $text
     * @return string
     */
    private function processHashtagsAndUrls($text)
    {
        // Bước 1: Thay thế hashtag, mention và URL bằng ký tự đặc biệt (placeholders)
        $text = preg_replace_callback('/#(\w+)/', function ($matches) {
            return '{{HASHTAG:' . $matches[1] . '}}';
        }, $text);

        $text = preg_replace_callback('/@(\w+)/', function ($matches) {
            return '{{MENTION:' . $matches[1] . '}}';
        }, $text);

        $text = preg_replace_callback('/(https?:\/\/[^\s]+)/', function ($matches) {
            return '{{URL:' . $matches[1] . '}}';
        }, $text);

        // Bước 2: Thay thế các placeholders bằng thẻ <a>
        $text = preg_replace_callback('/\{\{HASHTAG:([^\}]+)\}\}/', function ($matches) {
            return '<a href="https://x.com/hashtag/' . urlencode($matches[1]) . '" target="_blank">#' . $matches[1] . '</a>';
        }, $text);

        $text = preg_replace_callback('/\{\{MENTION:([^\}]+)\}\}/', function ($matches) {
            return '<a href="https://x.com/' . urlencode($matches[1]) . '" target="_blank">@' . $matches[1] . '</a>';
        }, $text);

        $text = preg_replace_callback('/\{\{URL:([^\}]+)\}\}/', function ($matches) {
            return '<a href="' . htmlspecialchars($matches[1]) . '" target="_blank">' . htmlspecialchars($matches[1]) . '</a>';
        }, $text);

        return $text;
    }

    private function handleRateLimit($response)
    {
        $rateLimitRemaining = $response->getHeader('X-Rate-Limit-Remaining');
        $rateLimitReset = $response->getHeader('X-Rate-Limit-Reset');

        if ($rateLimitRemaining[0] == 0) {
            // Tính thời gian chờ đến khi reset
            $resetTime = (int) $rateLimitReset[0];
            $sleepTime = $resetTime - time();

            if ($sleepTime > 0) {
                // Chờ đến khi reset rate limit
                sleep($sleepTime + 1);  // Thêm 1 giây để đảm bảo không gặp lỗi lại
            }
        }
    }
}
