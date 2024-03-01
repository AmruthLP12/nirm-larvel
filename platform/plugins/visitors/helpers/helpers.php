<?php

if (!function_exists('count_visitors')) {
    function count_visitors()
    {
        return 632 + \Obii\Visitors\Models\Visitors::count();
    }
}
if (!function_exists('get_last_updated')) {
    function get_last_updated()
    {
        // Cache the result for 1 minute
        $cacheKey = 'last_updated';
        $cacheDuration = 1; // in minutes
        return cache()->remember($cacheKey, $cacheDuration, function () {
            if (file_exists(public_path('data.json'))) {
                $json = file_get_contents(public_path('data.json'));
                $data = json_decode($json, true);
                return now()->parse($data['last_updated'])->format('M d, Y');
            }
            return now()->format('M d, Y');
        });
    }
}