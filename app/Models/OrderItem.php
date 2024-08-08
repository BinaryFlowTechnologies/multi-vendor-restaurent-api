<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['pivot'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function addons(): HasMany
    {
        return $this->hasMany(OrderItemAddon::class, 'item_id');
    }

    public function price() :Attribute
    {
        return new Attribute(
            fn($value) => $value / 100,
            fn ($value) => $value * 100
        );
    }
}
