<?php

namespace Obii\Block\Repositories\Caches;

use Obii\Support\Repositories\Caches\CacheAbstractDecorator;
use Obii\Block\Repositories\Interfaces\BlockInterface;

class BlockCacheDecorator extends CacheAbstractDecorator implements BlockInterface
{
    /**
     * {@inheritDoc}
     */
    public function createSlug($name, $id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
