<?php

namespace Obii\InformationSection\Providers;

use Obii\InformationSection\Models\InformationSection;
use Illuminate\Support\ServiceProvider;
use Obii\InformationSection\Repositories\Caches\InformationSectionCacheDecorator;
use Obii\InformationSection\Repositories\Eloquent\InformationSectionRepository;
use Obii\InformationSection\Repositories\Interfaces\InformationSectionInterface;
use Obii\Base\Supports\Helper;
use Illuminate\Support\Facades\Event;
use Obii\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class InformationSectionServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(InformationSectionInterface::class, function () {
            return new InformationSectionCacheDecorator(new InformationSectionRepository(new InformationSection));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/information-section')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([InformationSection::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-information-section',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/information-section::information-section.name',
                'icon'        => 'fa fa-list',
                'url'         => route('information-section.edit', 'what-is-new'),
                'permissions' => ['information-section.index'],
            ])
                ->registerItem([
                    'id'          => 'cms-plugins-information-what-is-new',
                    'priority'    => 5,
                    'parent_id'   => 'cms-plugins-information-section',
                    'name'        => 'What\'s new',
                    'icon'        => 'fa fa-list',
                    'url'         => route('information-section.edit', 'what-is-new'),
                    'permissions' => ['information-section.create'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-information-announcements',
                    'priority'    => 5,
                    'parent_id'   => 'cms-plugins-information-section',
                    'name'        => 'Announcements',
                    'icon'        => 'fa fa-list',
                    'url'         => route('information-section.edit', 'announcements'),
                    'permissions' => ['information-section.create'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-information-press-release',
                    'priority'    => 5,
                    'parent_id'   => 'cms-plugins-information-section',
                    'name'        => 'Press Releases',
                    'icon'        => 'fa fa-list',
                    'url'         => route('information-section.edit', 'press-release'),
                    'permissions' => ['information-section.create'],
                ]);
        });
    }
}
