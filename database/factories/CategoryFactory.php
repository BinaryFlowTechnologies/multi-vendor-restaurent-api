<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $categoryName = $this->faker->streetName;

        return [
            'name' => $categoryName,
            'slug' => Str::slug($categoryName),
            'sort' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement([true, false]),
            'restaurant_id' => $this->faker->randomElement(Restaurant::all()->pluck('id')->toArray()),
        ];

    }
}
