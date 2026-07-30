<?php

namespace Obii\AuditLog\Providers;

use Obii\AuditLog\Commands\ActivityLogClearCommand;
use Obii\AuditLog\Commands\CleanOldLogsCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ActivityLogClearCommand::class,
                CleanOldLogsCommand::class,
            ]);
        }
    }
}
