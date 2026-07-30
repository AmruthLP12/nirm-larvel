<?php

namespace Obii\Widget\Repositories\Interfaces;

use Obii\Support\Repositories\Interfaces\RepositoryInterface;

interface WidgetInterface extends RepositoryInterface
{
    /**
     * Get all theme widgets
     * @param string $theme
     * @return mixed
     */
    public function getByTheme($theme);
}
