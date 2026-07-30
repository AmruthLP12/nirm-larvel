<?php

namespace Obii\CustomField\Providers;

use Obii\Base\Events\CreatedContentEvent;
use Obii\Base\Events\DeletedContentEvent;
use Obii\Base\Events\UpdatedContentEvent;
use Obii\CustomField\Listeners\CreatedContentListener;
use Obii\CustomField\Listeners\DeletedContentListener;
use Obii\CustomField\Listeners\UpdatedContentListener;
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
    ];
}
