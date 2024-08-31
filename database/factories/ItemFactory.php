<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition (): array
    {
        $categories = Category::all()->pluck('id');

        return [
            'category_id'   => $this->faker->randomElement($categories),
            'name'          => $this->faker->words(3, true),
            'price'         => $this->faker->numberBetween(1, 200),
            'sort'          => $this->faker->numberBetween(1, 200),
            'description'   => $this->faker->words(5, true),
            'status'        => $this->faker->randomElement([true, false]),
            'restaurant_id' => $this->faker->randomElement(Restaurant::all()->pluck('id')->toArray()),
        ];
    }
}
