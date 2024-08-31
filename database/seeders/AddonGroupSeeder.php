<?php

namespace Database\Seeders;

use App\Models\Addon;
use App\Models\AddonGroup;
use Illuminate\Database\Seeder;

class AddonGroupSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run (): void
  {
	AddonGroup::factory()->count(30)->afterCreating(function($group) {
	  Addon::factory()->count(10)->state([
		  'addon_group_id' => $group->id
	  ])
		  ->create();
	})
		->create();
  }
}
