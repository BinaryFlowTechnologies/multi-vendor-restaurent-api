<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItemAddon extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'item_id');
    }

    public function mainAddon(): BelongsTo
    {
        return $this->belongsTo(Addon::class, 'addon_id');
    }


    public function price() :Attribute
    {
        return new Attribute(
            fn($value) => $value / 100,
            fn ($value) => $value * 100
        );
    }
}
