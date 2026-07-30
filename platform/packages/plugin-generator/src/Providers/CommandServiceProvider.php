<?php

namespace Obii\PluginGenerator\Providers;

use Obii\PluginGenerator\Commands\PluginCreateCommand;
use Obii\PluginGenerator\Commands\PluginListCommand;
use Obii\PluginGenerator\Commands\PluginMakeCrudCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PluginListCommand::class,
                PluginCreateCommand::class,
                PluginMakeCrudCommand::class,
            ]);
        }
    }
}
