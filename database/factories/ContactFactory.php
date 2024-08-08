<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name,
            'email'   => $this->faker->email,
            'subject' => $this->faker->text(10),
            'message' => $this->faker->paragraph(10, false),
        ];
    }
}
