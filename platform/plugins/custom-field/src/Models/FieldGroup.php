<?php

namespace Obii\CustomField\Models;

use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Models\BaseModel;
use Obii\Base\Traits\EnumCastable;
use Obii\CustomField\Repositories\Interfaces\FieldItemInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FieldGroup extends BaseModel
{
    use EnumCastable;

    /**
     * @var string
     */
    protected $table = 'field_groups';

    /**
     * @var array
     */
    protected $fillable = [
        'order',
        'rules',
        'title',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (FieldGroup $fieldGroup) {
            app(FieldItemInterface::class)->deleteBy(['field_group_id' => $fieldGroup->id]);
        });
    }

    /**
     * @return HasMany
     */
    public function fieldItems(): HasMany
    {
        return $this->hasMany(FieldItem::class, 'field_group_id');
    }
}
