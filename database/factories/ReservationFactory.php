<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $dateTime = Carbon::now()
            ->addDays($this->faker->numberBetween(1, 5))
            ->setHours($this->faker->numberBetween(1, 5))
            ->setMinutes($this->faker->numberBetween(10, 30))
        ;

        $status = $this->faker->randomElement([
            Reservation::STATUS_PENDING,
            Reservation::STATUS_CONFIRMED,
            Reservation::STATUS_CANCELLED
        ]);

        $person = $this->faker->numberBetween(1, 15);

        $user = $this->faker->randomElement(User::all());

        return [
            'name'                   => $user->name,
            'phone'                  => $user->phone ?: $this->faker->phoneNumber,
            'person'                 => $person,
            'email'                  => $user->email,
            'datetime'               => $dateTime,
            'note'                   => $this->faker->words(5, true),
            'status'                 => $status,
            'last_email_send_status' => $this->faker->randomElement([true, false]),
        ];
    }
}
