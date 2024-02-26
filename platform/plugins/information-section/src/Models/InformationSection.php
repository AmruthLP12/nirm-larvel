<?php

namespace Obii\InformationSection\Models;

use Obii\Base\Traits\EnumCastable;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Models\BaseModel;

class InformationSection extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'information_sections';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'link_readmore',
        'options',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
