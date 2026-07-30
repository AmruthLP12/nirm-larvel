<?php

namespace Obii\Dashboard\Repositories\Interfaces;

use Obii\Support\Repositories\Interfaces\RepositoryInterface;

interface DashboardWidgetSettingInterface extends RepositoryInterface
{
    /**
     * @return mixed
     *
     * @since 2.1
     */
    public function getListWidget();
}
