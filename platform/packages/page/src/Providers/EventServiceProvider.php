<?php

namespace Obii\Page\Providers;

use Obii\Page\Listeners\RenderingSiteMapListener;
use Obii\Theme\Events\RenderingSiteMapEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RenderingSiteMapEvent::class => [
            RenderingSiteMapListener::class,
        ],
    ];
}
