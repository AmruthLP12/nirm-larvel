<?php

namespace Obii\Twitterfeed\Commands;

use Exception;
use Illuminate\Console\Command;
use Obii\Twitterfeed\Services\TwitterService;
use Obii\Twitterfeed\Models\Twitterfeed;

class CloneTwitterCommand extends Command
{
    /**
     * @var TwitterService
     */
    public $twitterService;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'cms:twitter:clone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clone a twitter feed';

    /**
     * BackupCommand constructor.
     */
    public function __construct(TwitterService $twitterService)
    {
        parent::__construct();
        $this->twitterService = $twitterService;
    }

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle()
    {
        try {
            $username = 'nirmrockmech';
            $this->info('Cloning twitter feed for ' . $username . '...');
            $feeds = $this->twitterService->getTweetsByUsername($username, 20);
            $countCloned = 0;
            //save to database if not exists
            foreach ($feeds as $feed) {
                $tweetId = $feed['id'];
                $status = 'published';

                $tweet = Twitterfeed::where('tweet_id', $tweetId)->first();
                if (!$tweet) {
                    Twitterfeed::create([
                        'tweet_id' => $tweetId,
                        'content' => $feed,
                        'status' => $status,
                        'created_at' => now()->parse($feed['created_at'])->toDateTimeString(),
                    ]);
                    $countCloned++;
                }
            }
            $this->info('Done! Cloned ' . $countCloned . ' tweets!');
            
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }

        return 0;
    }
}
