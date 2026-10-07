<?php

namespace Obii\Language\Providers;

use Artisan;
use Obii\Base\Events\CreatedContentEvent;
use Obii\Base\Events\DeletedContentEvent;
use Obii\Base\Events\UpdatedContentEvent;
use Obii\Language\Listeners\ActivatedPluginListener;
use Obii\Language\Listeners\CreatedContentListener;
use Obii\Language\Listeners\DeletedContentListener;
use Obii\Language\Listeners\ThemeRemoveListener;
use Obii\Language\Listeners\UpdatedContentListener;
use Obii\PluginManagement\Events\ActivatedPluginEvent;
use Obii\Theme\Events\ThemeRemoveEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UpdatedContentEvent::class => [
            UpdatedContentListener::class,
        ],
        CreatedContentEvent::class => [
            CreatedContentListener::class,
        ],
        DeletedContentEvent::class => [
            DeletedContentListener::class,
        ],
        ThemeRemoveEvent::class    => [
            ThemeRemoveListener::class,
        ],
        ActivatedPluginEvent::class    => [
            ActivatedPluginListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();

        if (version_compare(get_cms_version(), '7.0') > 0) {
            Event::listen(['cache:cleared'], function () {
                Artisan::call('route:trans:clear');
            });
        }
    }
}
