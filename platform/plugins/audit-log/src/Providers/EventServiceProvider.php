<?php

namespace Obii\AuditLog\Providers;

use Obii\AuditLog\Events\AuditHandlerEvent;
use Obii\AuditLog\Listeners\AuditHandlerListener;
use Obii\AuditLog\Listeners\CreatedContentListener;
use Obii\AuditLog\Listeners\DeletedContentListener;
use Obii\AuditLog\Listeners\LoginListener;
use Obii\AuditLog\Listeners\UpdatedContentListener;
use Obii\Base\Events\CreatedContentEvent;
use Obii\Base\Events\DeletedContentEvent;
use Obii\Base\Events\UpdatedContentEvent;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AuditHandlerEvent::class   => [
            AuditHandlerListener::class,
        ],
        Login::class               => [
            LoginListener::class,
        ],
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
