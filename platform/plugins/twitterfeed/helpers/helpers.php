<?php

//get feeds from database

if (!function_exists('get_tweets')) {
    function get_tweets($limit = 30)
    {
        $feeds = \Obii\Twitterfeed\Models\Twitterfeed::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        return $feeds;
    }
}
