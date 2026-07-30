<?php

namespace Obii\AuditLog\Providers;

use Obii\AuditLog\Facades\AuditLogFacade;
use Obii\AuditLog\Models\AuditHistory;
use Obii\AuditLog\Repositories\Caches\AuditLogCacheDecorator;
use Obii\AuditLog\Repositories\Eloquent\AuditLogRepository;
use Obii\AuditLog\Repositories\Interfaces\AuditLogInterface;
use Obii\Base\Supports\Helper;
use Obii\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Support\Facades\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\ServiceProvider;

/**
 * @since 02/07/2016 09:05 AM
 */
class AuditLogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(AuditLogInterface::class, function () {
            return new AuditLogCacheDecorator(new AuditLogRepository(new AuditHistory));
        });

        AliasLoader::getInstance()->alias('AuditLog', AuditLogFacade::class);

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);

        $this->setNamespace('plugins/audit-log')
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->publishAssets();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-plugin-audit-log',
                    'priority'    => 8,
                    'parent_id'   => 'cms-core-platform-administration',
                    'name'        => 'plugins/audit-log::history.name',
                    'icon'        => null,
                    'url'         => route('audit-log.index'),
                    'permissions' => ['audit-log.index'],
                ]);
        });

        $this->app->booted(function () {
            $this->app->register(HookServiceProvider::class);

            $schedule = $this->app->make(Schedule::class);

            $schedule->command('model:prune', ['--model' => AuditHistory::class])->dailyAt('00:30');
        });
    }
}
