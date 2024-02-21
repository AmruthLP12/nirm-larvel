<?php

namespace Obii\CustomField\Facades;

use Illuminate\Support\Facades\Facade;
use Obii\CustomField\Support\CustomFieldSupport;

class CustomFieldSupportFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CustomFieldSupport::class;
    }
}
