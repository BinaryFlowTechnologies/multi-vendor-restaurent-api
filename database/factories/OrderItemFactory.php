<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $item = $this->faker->randomElement(Item::all());

        return [
            'item_id' => $item->id,
            'name'    => $item->name,
            'price'   => $item->price,
            'qty'     => $this->faker->numberBetween(1, 10),
        ];
    }
}
