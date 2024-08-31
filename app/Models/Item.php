<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  public function category (): BelongsTo
  {
	return $this->belongsTo(Category::class);
  }

  public function addonGroups (): BelongsToMany
  {
	return $this->belongsToMany(AddonGroup::class)->withTimestamps();
  }


  public function price (): Attribute
  {
	return new Attribute(
		get: fn($value) => $value / 100,
		set: fn($value) => $value * 100
	);
  }
}
