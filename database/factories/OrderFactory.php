<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition (): array
    {

        $user = $this->faker->randomElement(User::all());
        $userAddress = UserAddress::where('user_id', $user->id)->first();

        $subtotal = $this->faker->numberBetween(100, 500);

        $orderStatus = $this->faker->randomElement([Order::STATUS_PENDING, Order::STATUS_PROCESSING, Order::STATUS_DELIVERING, Order::STATUS_DELIVERED, Order::STATUS_CANCELLED]);

        return [
            'user_id'                => $user->id,
            'order_type'             => $this->faker->randomElement([Order::TYPE_COLLECTION, Order::TYPE_DELIVERY]),
            'subtotal'               => $subtotal,
            'total'                  => $subtotal,
            'customer_name'          => $user->name,
            'customer_phone'         => $user->phone,
            'customer_email'         => $user->email,
            'house_no'               => $userAddress->house_no,
            'street_name'            => $userAddress->street_name,
            'city'                   => $userAddress->city,
            'county'                 => $userAddress->county,
            'postcode'               => $userAddress->postcode,
            'status'                 => $orderStatus,
            'payment_status'         => $this->faker->randomElement([true, false]),
            'print_status'           => $this->faker->randomElement([true, false]),
            'notification_status'    => $this->faker->randomElement([true, false]),
            'email_status'           => $this->faker->randomElement([true, false]),
            'requested_time_is_asap' => $this->faker->randomElement([true, false]),
            'restaurant_id'          => $this->faker->randomElement(Restaurant::all()->pluck('id')->toArray()),
        ];
    }
}
