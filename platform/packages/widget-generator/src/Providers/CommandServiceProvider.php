<?php

namespace Obii\WidgetGenerator\Providers;

use Obii\WidgetGenerator\Commands\WidgetCreateCommand;
use Obii\WidgetGenerator\Commands\WidgetRemoveCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                WidgetCreateCommand::class,
                WidgetRemoveCommand::class,
            ]);
        }
    }
}
