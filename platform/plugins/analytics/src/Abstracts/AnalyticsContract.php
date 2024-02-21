<?php

namespace Obii\Analytics\Abstracts;

use Obii\Analytics\Period;
use Google\Service\Analytics\GaData;
use Illuminate\Support\Collection;

interface AnalyticsContract
{
    public function fetchMostVisitedPages(Period $period, int $maxResults = 20): Collection;

    public function fetchTopReferrers(Period $period, int $maxResults = 20): Collection;

    public function fetchTopBrowsers(Period $period, int $maxResults = 10): Collection;

    public function performQuery(Period $period, string $metrics, array $others = []);
}
