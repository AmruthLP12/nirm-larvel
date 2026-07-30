<?php

namespace Obii\Base\Providers;

use Obii\Base\Commands\ClearLogCommand;
use Obii\Base\Commands\InstallCommand;
use Obii\Base\Commands\PublishAssetsCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            ClearLogCommand::class,
            InstallCommand::class,
            PublishAssetsCommand::class,
        ]);
    }
}
