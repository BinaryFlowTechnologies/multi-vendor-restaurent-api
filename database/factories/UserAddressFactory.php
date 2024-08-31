<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition (): array
  {
	return [
		'type'        => $this->faker->randomElement([UserAddress::TYPE_HOME, UserAddress::TYPE_WORK]),
		'house_no'    => $this->faker->randomDigit(),
		'street_name' => $this->faker->streetName,
		'city'        => $this->faker->city,
		'county'      => $this->faker->streetAddress,
		'postcode'    => $this->faker->postcode,
		'lat'         => 51.508366,
		'long'        => -0.138450,
		'note'        => $this->faker->words(3, true),
		'is_default'  => $this->faker->randomElement([true, false])
	];
  }
}
