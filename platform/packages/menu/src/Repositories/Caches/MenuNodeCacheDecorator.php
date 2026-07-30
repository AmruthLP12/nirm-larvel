<?php

namespace Obii\Menu\Repositories\Caches;

use Obii\Menu\Repositories\Interfaces\MenuNodeInterface;
use Obii\Support\Repositories\Caches\CacheAbstractDecorator;

class MenuNodeCacheDecorator extends CacheAbstractDecorator implements MenuNodeInterface
{
    /**
     * {@inheritDoc}
     */
    public function getByMenuId($menuId, $parentId, $select = ['*'], array $with = ['child'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
