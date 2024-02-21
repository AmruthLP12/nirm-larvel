<?php

namespace Obii\Base\Providers;

use Obii\Base\Events\BeforeEditContentEvent;
use Obii\Base\Events\CreatedContentEvent;
use Obii\Base\Events\DeletedContentEvent;
use Obii\Base\Events\SendMailEvent;
use Obii\Base\Events\UpdatedContentEvent;
use Obii\Base\Listeners\BeforeEditContentListener;
use Obii\Base\Listeners\CreatedContentListener;
use Obii\Base\Listeners\DeletedContentListener;
use Obii\Base\Listeners\SendMailListener;
use Obii\Base\Listeners\UpdatedContentListener;
use Illuminate\Support\Facades\Event;
use File;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SendMailEvent::class          => [
            SendMailListener::class,
        ],
        CreatedContentEvent::class    => [
            CreatedContentListener::class,
        ],
        UpdatedContentEvent::class    => [
            UpdatedContentListener::class,
        ],
        DeletedContentEvent::class    => [
            DeletedContentListener::class,
        ],
        BeforeEditContentEvent::class => [
            BeforeEditContentListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();

        Event::listen(['cache:cleared'], function () {
            File::delete([storage_path('cache_keys.json'), storage_path('settings.json')]);
        });
    }
}
