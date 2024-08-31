<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition (): array
    {
        $name = $this->faker->company;
        return [
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => $this->faker->sentence,
            'address'     => $this->faker->address,
            'phone'       => $this->faker->phoneNumber,
            'email'       => $this->faker->companyEmail,
            'website'     => $this->faker->url,
            'logo'        => $this->faker->imageUrl(),
            'rating'      => $this->faker->randomFloat(1, 0, 5),
            'status'      => $this->faker->randomElement([true, false]),
        ];
    }

    public function configure (): RestaurantFactory|Factory
    {
        return $this->afterCreating(function (\App\Models\Restaurant $restaurant) {
            $restaurant->cuisines()->createMany(\App\Models\RestaurantCuisine::factory(3)->make()->toArray());
        });
    }
}
