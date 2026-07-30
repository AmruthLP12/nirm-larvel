<?php

namespace Obii\Slider\Repositories\Eloquent;

use Obii\Base\Enums\BaseStatusEnum;
use Obii\Support\Repositories\Eloquent\RepositoriesAbstract;
use Obii\Slider\Repositories\Interfaces\SliderInterface;

class SliderRepository extends RepositoriesAbstract implements SliderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAll(array $with = [])
    {
        $data = $this->model
            ->with($with)
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->orderBy('order');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getFeaturedSliders($limit, array $with = [])
    {
        $data = $this->model
            ->with($with)
            ->where([
                'status'   => BaseStatusEnum::PUBLISHED,
            ])
            ->select([
                'id',
                'title',
                'image',
                'description',
                'title_button',
                'link',
                'created_at',
            ])
            ->orderBy('order')
            ->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
