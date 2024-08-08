<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AddonGroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class)->withTimestamps();
    }

    public function addons(): HasMany
    {
        return $this->hasMany(Addon::class);
    }


    public function price():Attribute
    {
        return new Attribute(
            fn($value) => $value / 100,
            fn($value) => $value * 100
        );
    }
}
