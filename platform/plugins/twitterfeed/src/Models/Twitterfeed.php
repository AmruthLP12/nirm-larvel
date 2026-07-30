<?php

namespace Obii\Twitterfeed\Models;

use Obii\Base\Traits\EnumCastable;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Models\BaseModel;

class Twitterfeed extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'twitterfeeds';

    /**
     * @var array
     */
    protected $fillable = [
        'tweet_id',
        'content',
        'status',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
        'content' => 'array',
    ];
}
