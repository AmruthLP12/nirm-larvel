<?php

namespace Obii\SeoHelper\Providers;

use Obii\Base\Supports\Helper;
use Obii\Base\Traits\LoadAndPublishDataTrait;
use Obii\SeoHelper\Contracts\SeoHelperContract;
use Obii\SeoHelper\Contracts\SeoMetaContract;
use Obii\SeoHelper\Contracts\SeoOpenGraphContract;
use Obii\SeoHelper\Contracts\SeoTwitterContract;
use Obii\SeoHelper\SeoHelper;
use Obii\SeoHelper\SeoMeta;
use Obii\SeoHelper\SeoOpenGraph;
use Obii\SeoHelper\SeoTwitter;
use Illuminate\Support\ServiceProvider;

/**
 * @since 02/12/2015 14:09 PM
 */
class SeoHelperServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(SeoMetaContract::class, SeoMeta::class);
        $this->app->bind(SeoHelperContract::class, SeoHelper::class);
        $this->app->bind(SeoOpenGraphContract::class, SeoOpenGraph::class);
        $this->app->bind(SeoTwitterContract::class, SeoTwitter::class);

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('packages/seo-helper')
            ->loadAndPublishConfigurations(['general'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->publishAssets();

        $this->app->register(EventServiceProvider::class);

        $this->app->booted(function () {
            $this->app->register(HookServiceProvider::class);
        });
    }
}
