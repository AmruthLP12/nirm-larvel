<?php

namespace Obii\InformationSection\Repositories\Interfaces;

use Obii\Support\Repositories\Interfaces\RepositoryInterface;

interface InformationSectionInterface extends RepositoryInterface
{
    public function getInformationSectionByType($type);
    public function getPublished();
}
