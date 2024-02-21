<?php

namespace Obii\Slider\Repositories\Caches;

use Obii\Support\Repositories\Caches\CacheAbstractDecorator;
use Obii\Slider\Repositories\Interfaces\SliderInterface;

class SliderCacheDecorator extends CacheAbstractDecorator implements SliderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAll(array $with = ['user'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    /**
     * {@inheritDoc}
     */
    public function getFeaturedSliders($limit, array $with = ['user'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
