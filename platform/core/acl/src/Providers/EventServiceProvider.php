<?php

namespace Obii\ACL\Providers;

use Obii\ACL\Events\RoleAssignmentEvent;
use Obii\ACL\Events\RoleUpdateEvent;
use Obii\ACL\Listeners\LoginListener;
use Obii\ACL\Listeners\RoleAssignmentListener;
use Obii\ACL\Listeners\RoleUpdateListener;
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
        RoleUpdateEvent::class     => [
            RoleUpdateListener::class,
        ],
        RoleAssignmentEvent::class => [
            RoleAssignmentListener::class,
        ],
        Login::class               => [
            LoginListener::class,
        ],
    ];
}
