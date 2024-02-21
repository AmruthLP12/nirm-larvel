<?php

namespace Obii\Menu\Providers;

use Obii\Base\Events\DeletedContentEvent;
use Obii\Menu\Listeners\DeleteMenuNodeListener;
use Obii\Menu\Listeners\UpdateMenuNodeUrlListener;
use Obii\Slug\Events\UpdatedSlugEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UpdatedSlugEvent::class    => [
            UpdateMenuNodeUrlListener::class,
        ],
        DeletedContentEvent::class => [
            DeleteMenuNodeListener::class,
        ],
    ];
}
