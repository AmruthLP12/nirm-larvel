<?php

namespace Obii\Base\Facades;

use Obii\Base\Supports\EmailHandler;
use Illuminate\Support\Facades\Facade;

class EmailHandlerFacade extends Facade
{

    /**
     * @return string
     * @since 2.2
     */
    protected static function getFacadeAccessor()
    {
        return EmailHandler::class;
    }
}
