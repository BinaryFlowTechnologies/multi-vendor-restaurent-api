<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Addon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['pivot'];

    protected $casts = [
        'available_for_free' => 'boolean'
    ];

    public const TYPE_ITEM = 1;
    public const TYPE_OTHER = 2;

    public function group(): BelongsTo
    {
        return $this->belongsTo(AddonGroup::class, 'addon_group_id');
    }


    public function type(): Attribute
    {
        return new Attribute(
            fn($value) => match ($value) {
                self::TYPE_ITEM => 'Item',
                self::TYPE_OTHER => 'Other',
                default => $value,
            },
            fn($value) => match ($value) {
                ('item' || 'Item') => self::TYPE_ITEM,
                ('other' || 'Other') => self::TYPE_OTHER,
                default => $value,
            },
        );
    }


    public function price(): Attribute
    {
        return new Attribute(
            fn($value) => $value / 100,
            fn($value) => $value * 100
        );
    }
}
