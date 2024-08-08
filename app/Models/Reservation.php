<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['pivot'];

    public const STATUS_PENDING = 0;
    public const STATUS_CONFIRMED = 1;
    public const STATUS_CANCELLED = 2;

    public function status(): Attribute
    {
        return new Attribute(
            get: fn($value) => match ($value) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_CANCELLED => 'Cancelled'
        },
            set: fn($value) => match ($value) {
            'Pending' => self::STATUS_PENDING,
            'Confirmed' => self::STATUS_CONFIRMED,
            'Cancelled' => self::STATUS_CANCELLED,
            default => $value
        }
        );
    }

}
