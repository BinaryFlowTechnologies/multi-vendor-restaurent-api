<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        Order::factory()
            ->count(50)
            ->afterCreating(function($order){

                OrderItem::factory()->count(4)
                    ->state([
                    'order_id' => $order->id
                ])->create()
                ;
            })
            ->create()
        ;
    }
}
