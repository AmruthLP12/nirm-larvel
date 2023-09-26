<?php

namespace App\Http\Controllers;

use App\Crawler\ArrayCrawlQueue;
use Spatie\Crawler\Crawler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Crawler\CrawlInternalUrls;
use DOMDocument;

class CrawlUrlController extends Controller
{
    public function index(Request $request)
    {
        $url = 'https://nirm.in/';

        if (!is_null($url)) {
            // Get or create a new array queue.
            $queue = Cache::remember(md5($url), 3600, function () {
                return new ArrayCrawlQueue;
            });

            // Alternatively, this queue stores the data directly in the cache
            // $queue = new \Spekulatius\SpatieCrawlerToolkit\Queues\CacheCrawlQueue($url);

            Crawler::create()
                ->setCrawlProfile(new CrawlInternalUrls($url))
                ->setCurrentCrawlLimit(5)
                ->setDelayBetweenRequests(150)
                ->setCrawlQueue($queue)
                // ->setCrawlProfile(new \Spatie\Crawler\CrawlProfiles\CrawlSubdomains($url))
                ->startCrawling($url);
            $route = [];
            $contentTmp = file_get_contents(resource_path('views/tmp.blade.php'));
            foreach ($queue->getUrls() as $urlFound => $value) {
                if ($url !== $urlFound) {
                    $fileName = \Str::slug(str_replace('.php', '', $value->url->getPath()), '-');
                    if (!file_exists(resource_path("views/{$fileName}.blade.php"))) {
                        $dom = new DOMDocument();
                        libxml_use_internal_errors(true);
                        $dom->loadHTMLFile($urlFound);
                        $htmlId = $dom->saveHTML($dom->getElementById('contentWrapper'));

                        $contentUpdated = str_replace('{{$content}}', $htmlId, $contentTmp);
                        file_put_contents(resource_path("views/{$fileName}.blade.php"), $contentUpdated);

                        $route[] = "Route::get('{$value->url->getPath()}', function () {
                            return view('{$fileName}');
                        });";
                    }
                }
            }
            echo "<pre>" . implode("\n", $route) . "</pre>";
            die();
        }
    }
}
