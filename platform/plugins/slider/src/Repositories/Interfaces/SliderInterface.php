<?php

namespace Obii\Slider\Repositories\Interfaces;

use Obii\Support\Repositories\Interfaces\RepositoryInterface;

interface SliderInterface extends RepositoryInterface
{
    /**
     * Get all galleries.
     *
     * @param array $with
     * @return mixed
     */
    public function getAll(array $with = []);

    /**
     * @param int $limit
     * @param array $with
     */
    public function getFeaturedSliders($limit, array $with = []);
}
