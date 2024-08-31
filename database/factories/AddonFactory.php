<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition (): array
    {
        return [
            'name'          => $this->faker->words(asText: true),
            'price'         => $this->faker->numberBetween(0, 1000),
            'type'          => $this->faker->randomElement([1, 2]),
            'sort'          => $this->faker->numberBetween(100, 900),
            'status'        => $this->faker->randomElement([true, false]),
            'restaurant_id' => $this->faker->randomElement(Restaurant::all()->pluck('id')->toArray()),
        ];
    }
}
