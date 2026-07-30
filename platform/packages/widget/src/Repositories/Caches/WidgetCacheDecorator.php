<?php

namespace Obii\Widget\Repositories\Caches;

use Obii\Support\Repositories\Caches\CacheAbstractDecorator;
use Obii\Widget\Repositories\Interfaces\WidgetInterface;

class WidgetCacheDecorator extends CacheAbstractDecorator implements WidgetInterface
{
    /**
     * {@inheritDoc}
     */
    public function getByTheme($theme)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
