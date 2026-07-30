<?php

namespace Obii\Widget\Repositories\Eloquent;

use Obii\Support\Repositories\Eloquent\RepositoriesAbstract;
use Obii\Widget\Repositories\Interfaces\WidgetInterface;

class WidgetRepository extends RepositoriesAbstract implements WidgetInterface
{
    /**
     * {@inheritDoc}
     */
    public function getByTheme($theme)
    {
        $data = $this->model->where('theme', $theme)->get();
        $this->resetModel();

        return $data;
    }
}
