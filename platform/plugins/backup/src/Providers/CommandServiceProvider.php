<?php

namespace Obii\Backup\Providers;

use Obii\Backup\Commands\BackupCreateCommand;
use Obii\Backup\Commands\BackupListCommand;
use Obii\Backup\Commands\BackupRemoveCommand;
use Obii\Backup\Commands\BackupRestoreCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BackupCreateCommand::class,
                BackupRestoreCommand::class,
                BackupRemoveCommand::class,
                BackupListCommand::class,
            ]);
        }
    }
}
