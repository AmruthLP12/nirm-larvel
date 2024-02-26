<?php

namespace Obii\InformationSection\Repositories\Eloquent;

use Obii\Support\Repositories\Eloquent\RepositoriesAbstract;
use Obii\InformationSection\Repositories\Interfaces\InformationSectionInterface;

class InformationSectionRepository extends RepositoriesAbstract implements InformationSectionInterface
{
    public function getInformationSectionByType($type)
    {
        return $this->model->where('type', $type)->first();
    }

    public function getPublished()
    {
        return $this->model->where('status', 'published')->get();
    }
}
