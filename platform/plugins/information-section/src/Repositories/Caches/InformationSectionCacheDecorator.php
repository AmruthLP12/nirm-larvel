<?php

namespace Obii\InformationSection\Repositories\Caches;

use Obii\Support\Repositories\Caches\CacheAbstractDecorator;
use Obii\InformationSection\Repositories\Interfaces\InformationSectionInterface;

class InformationSectionCacheDecorator extends CacheAbstractDecorator implements InformationSectionInterface
{
    public function getInformationSectionByType($type)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    public function getPublished()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
