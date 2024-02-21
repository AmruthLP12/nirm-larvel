<?php

namespace Obii\Slider\Models;

use Obii\Base\Traits\EnumCastable;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Models\BaseModel;

class Slider extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sliders';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'title_button',
        'link',
        'image',
        'order',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
