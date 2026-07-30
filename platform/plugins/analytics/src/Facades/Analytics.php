<?php

namespace Obii\Analytics\Facades;

use Obii\Analytics\Abstracts\AnalyticsAbstract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection|\Google\Service\Analytics\GaData|array|null performQuery(\Obii\Analytics\Period $period, string $metrics, array $others = [])
 * @method static \Illuminate\Support\Collection fetchMostVisitedPages(\Obii\Analytics\Period $period, int $maxResults = 20)
 * @method static \Illuminate\Support\Collection fetchTopReferrers(\Obii\Analytics\Period $period, int $maxResults = 20)
 * @method static \Illuminate\Support\Collection fetchUserTypes(\Obii\Analytics\Period $period)
 * @method static \Illuminate\Support\Collection fetchTopBrowsers(\Obii\Analytics\Period $period, int $maxResults = 10)
 * @method static \Google_Service_Analytics getAnalyticsService()
 * @method static string getPropertyId()
 * @method static static setPropertyId(string $propertyId)
 * @method static void macro(string $name, object|callable $macro)
 * @method static void mixin(object $mixin, bool $replace = true)
 * @method static bool hasMacro(string $name)
 * @method static void flushMacros()
 *
 * @see \Obii\Analytics\Analytics
 */
class Analytics extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AnalyticsAbstract::class;
    }
}
