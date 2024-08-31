<?php

namespace Database\Seeders;

use App\Models\AddonGroup;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run (): void
  {
	Item::factory()->count(50)->afterCreating(function($item) {
	  $addonGroups = AddonGroup::inRandomOrder()->limit(3)->get('id');
	  $item->addonGroups()->sync($addonGroups);
	})->create();
  }
}
