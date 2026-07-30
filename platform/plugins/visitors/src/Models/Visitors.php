<?php

namespace Obii\Visitors\Models;

use Obii\Base\Traits\EnumCastable;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Models\BaseModel;

class Visitors extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visitors';

    /**
     * @var array
     */
    protected $fillable = [
        'ip_address',
        'user_agent',
        'visited_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
    ];
}
