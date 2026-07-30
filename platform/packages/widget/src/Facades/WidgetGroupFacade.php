<?php

namespace Obii\Widget\Facades;

use Illuminate\Support\Facades\Facade;

class WidgetGroupFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'obii.widget-group-collection';
    }
}
