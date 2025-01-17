<?php

namespace Obii\Twitterfeed\Providers;

use Obii\Twitterfeed\Models\Twitterfeed;
use Illuminate\Support\ServiceProvider;
use Obii\Twitterfeed\Repositories\Caches\TwitterfeedCacheDecorator;
use Obii\Twitterfeed\Repositories\Eloquent\TwitterfeedRepository;
use Obii\Twitterfeed\Repositories\Interfaces\TwitterfeedInterface;
use Obii\Base\Supports\Helper;
use Illuminate\Support\Facades\Event;
use Obii\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class TwitterfeedServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(TwitterfeedInterface::class, function () {
            return new TwitterfeedCacheDecorator(new TwitterfeedRepository(new Twitterfeed));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/twitterfeed')
            ->loadMigrations();

        //commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Obii\Twitterfeed\Commands\CloneTwitterCommand::class,
            ]);
        }
    }
}
