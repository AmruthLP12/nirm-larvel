<?php

namespace Obii\Block\Models;

use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Traits\EnumCastable;
use Obii\Base\Models\BaseModel;

class Block extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blocks';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'content',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
