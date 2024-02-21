<?php

namespace Theme\Nirm\Http\Controllers;

use Obii\Theme\Http\Controllers\PublicController;

class NirmController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function getIndex()
    {
        return parent::getIndex();
    }

    /**
     * {@inheritDoc}
     */
    public function getView($key = null)
    {
        return parent::getView($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteMap()
    {
        return parent::getSiteMap();
    }
}
