<?php

namespace Obii\DevTool\Providers;

use Obii\DevTool\Commands\LocaleCreateCommand;
use Obii\DevTool\Commands\LocaleRemoveCommand;
use Obii\DevTool\Commands\Make\ControllerMakeCommand;
use Obii\DevTool\Commands\Make\FormMakeCommand;
use Obii\DevTool\Commands\Make\ModelMakeCommand;
use Obii\DevTool\Commands\Make\RepositoryMakeCommand;
use Obii\DevTool\Commands\Make\RequestMakeCommand;
use Obii\DevTool\Commands\Make\RouteMakeCommand;
use Obii\DevTool\Commands\Make\TableMakeCommand;
use Obii\DevTool\Commands\PackageCreateCommand;
use Obii\DevTool\Commands\PackageRemoveCommand;
use Obii\DevTool\Commands\RebuildPermissionsCommand;
use Obii\DevTool\Commands\TestSendMailCommand;
use Obii\DevTool\Commands\TruncateTablesCommand;
use Obii\DevTool\Commands\PackageMakeCrudCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TableMakeCommand::class,
                ControllerMakeCommand::class,
                RouteMakeCommand::class,
                RequestMakeCommand::class,
                FormMakeCommand::class,
                ModelMakeCommand::class,
                RepositoryMakeCommand::class,
                PackageCreateCommand::class,
                PackageMakeCrudCommand::class,
                PackageRemoveCommand::class,
                TestSendMailCommand::class,
                TruncateTablesCommand::class,
                RebuildPermissionsCommand::class,
                LocaleRemoveCommand::class,
                LocaleCreateCommand::class,
            ]);
        }
    }
}
