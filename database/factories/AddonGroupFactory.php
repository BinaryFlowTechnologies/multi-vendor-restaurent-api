<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddonGroupFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition (): array
  {
	return [
		'name'        => $this->faker->words(2, asText: true),
		'description' => $this->faker->words(5, asText: true),
		'price'       => $this->faker->randomNumber(3),
		'sort'        => $this->faker->numberBetween([0, 99]),
		'status'      => $this->faker->randomElement([true, false]),
	];
  }
}
