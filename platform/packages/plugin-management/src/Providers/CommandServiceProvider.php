<?php

namespace Obii\PluginManagement\Providers;

use Obii\PluginManagement\Commands\PluginActivateAllCommand;
use Obii\PluginManagement\Commands\PluginActivateCommand;
use Obii\PluginManagement\Commands\PluginAssetsPublishCommand;
use Obii\PluginManagement\Commands\PluginDeactivateCommand;
use Obii\PluginManagement\Commands\PluginRemoveCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PluginAssetsPublishCommand::class,
            ]);
        }

        $this->commands([
            PluginActivateCommand::class,
            PluginDeactivateCommand::class,
            PluginRemoveCommand::class,
            PluginActivateAllCommand::class,
        ]);
    }
}
