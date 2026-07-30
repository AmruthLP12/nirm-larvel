<?php

namespace Obii\Base\Facades;

use Obii\Base\Supports\BreadcrumbsManager;
use Illuminate\Support\Facades\Facade;

class BreadcrumbsFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BreadcrumbsManager::class;
    }
}
