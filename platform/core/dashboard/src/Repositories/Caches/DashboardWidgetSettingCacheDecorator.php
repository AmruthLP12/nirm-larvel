<?php

namespace Obii\Dashboard\Repositories\Caches;

use Obii\Dashboard\Repositories\Interfaces\DashboardWidgetSettingInterface;
use Obii\Support\Repositories\Caches\CacheAbstractDecorator;

class DashboardWidgetSettingCacheDecorator extends CacheAbstractDecorator implements DashboardWidgetSettingInterface
{
    /**
     * {@inheritDoc}
     */
    public function getListWidget()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
