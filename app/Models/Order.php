<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['pivot'];

    protected $casts = [
        'payment_status' => 'boolean'
    ];

    // types
    public const TYPE_COLLECTION = 1;
    public const TYPE_DELIVERY = 2;

    // status
    public const STATUS_DRAFT = 0;
    public const STATUS_PENDING = 1;
    public const STATUS_PROCESSING = 2;
    public const STATUS_DELIVERING = 3;
    public const STATUS_DELIVERED = 4;
    public const STATUS_CANCELLED = 5;

    // Payment type
    public const PAYMENT_TYPE_CASH = 0;
    public const PAYMENT_TYPE_CARD = 1;
    public const PAYMENT_TYPE_PAYPAL = 2;


    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function addons(): HasMany
    {
        return $this->hasMany(OrderItemAddon::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function total(): Attribute
    {
        return new Attribute(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100
        );
    }

    public function subtotal(): Attribute
    {
        return new Attribute(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100
        );
    }

    public function discount(): Attribute
    {
        return new Attribute(
            fn($value) => $value / 100,
            fn($value) => $value * 100
        );
    }


    public function status(): Attribute
    {
        return new Attribute(
            get: fn($value) => match ($value) {
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_DELIVERING => 'Delivering',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_CANCELLED => 'Cancelled',
        },
            set: fn($value) => match (strtolower($value)) {
            'processing' => self::STATUS_PROCESSING,
            'delivering' => self::STATUS_DELIVERING,
            'delivered' => self::STATUS_DELIVERED,
            'cancelled' => self::STATUS_CANCELLED,
            'pending' => self::STATUS_PENDING,
            'draft' => self::STATUS_DRAFT,
            default => $value
        }
        );
    }

    public function orderType(): Attribute
    {
        return new Attribute(
            get: fn($value) => match ($value) {
            self::TYPE_COLLECTION => 'Collection',
            self::TYPE_DELIVERY => 'Delivery',
        },
            set: fn($value) => match ($value) {
            'delivery' || 'Delivery' => self::TYPE_DELIVERY,
            'collection' || 'Collection' => self::TYPE_COLLECTION,
            default => $value
        }
        );
    }

    public function paymentMethod(): Attribute
    {
        return new Attribute(
            fn($value) => match ($value) {
                self::PAYMENT_TYPE_CARD => 'CARD',
                self::PAYMENT_TYPE_PAYPAL => 'PAYPAL',
                default => 'CASH'
            },
            fn($value) => match ($value) {
                'card' => self::PAYMENT_TYPE_CARD,
                'paypal' => self::PAYMENT_TYPE_PAYPAL,
                'cash' => self::PAYMENT_TYPE_CASH,
                default => $value
            }
        );
    }

}
