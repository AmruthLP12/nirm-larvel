<?php

namespace Obii\Menu\Repositories\Caches;

use Obii\Menu\Repositories\Interfaces\MenuInterface;
use Obii\Support\Repositories\Caches\CacheAbstractDecorator;

class MenuCacheDecorator extends CacheAbstractDecorator implements MenuInterface
{

    /**
     * {@inheritDoc}
     */
    public function findBySlug($slug, $active, array $select = [], array $with = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function createSlug($name)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
