<?php

namespace Obii\Language\Providers;

use Obii\Language\Commands\RouteTranslationsCacheCommand;
use Obii\Language\Commands\RouteTranslationsClearCommand;
use Obii\Language\Commands\SyncOldDataCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (version_compare(get_cms_version(), '7.0') > 0) {
            $this->commands([
                SyncOldDataCommand::class,
                RouteTranslationsClearCommand::class,
                RouteTranslationsCacheCommand::class,
            ]);
        } else {
            $this->commands([
                SyncOldDataCommand::class,
            ]);
        }
    }
}
