<?php

namespace Obii\Twitterfeed\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Obii\Twitterfeed\Models\Twitterfeed;
use Illuminate\Support\ServiceProvider;
use Obii\Twitterfeed\Repositories\Caches\TwitterfeedCacheDecorator;
use Obii\Twitterfeed\Repositories\Eloquent\TwitterfeedRepository;
use Obii\Twitterfeed\Repositories\Interfaces\TwitterfeedInterface;
use Obii\Base\Supports\Helper;
use Obii\Base\Traits\LoadAndPublishDataTrait;

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

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            //every hour
            $schedule->command('cms:twitter:clone')->cron('0 * * * *');
        });
    }
}
