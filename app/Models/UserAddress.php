<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['pivot'];

    public const TYPE_HOME = 1;
    public const TYPE_WORK = 2;

    public const SHOP_COORDINATES = [
        'long' => 1.027312,
        'lat'  => 51.809649
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): Attribute
    {
        return new Attribute(
            get: fn($value) => match ($value) {
            self::TYPE_HOME => 'Home',
            self::TYPE_WORK => 'Work'
        }
        );
    }
}
