<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['pivot'];

    public function childs (): HasMany
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function parent (): BelongsTo
    {
        return $this->belongsTo($this, 'parent_id', 'id');
    }

    public function items (): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
