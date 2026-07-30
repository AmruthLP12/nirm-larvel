<?php

if (!function_exists('getInformationSectionPublished')) {
    function getInformationSectionPublished()
    {
        return app(\Obii\InformationSection\Repositories\Interfaces\InformationSectionInterface::class)->getPublished();
    }
}

if (!function_exists('shortOptionsByShortOrder')) {
    function shortOptionsByShortOrder($options)
    {
        $results = collect($options)->map(function ($option) {
            return collect($option)->pluck('value', 'key')->toArray();
        });
        return $results->sortBy('sort_order', SORT_ASC)->values()->all();
    }
}
