<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run (): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            UserAddressSeeder::class,
            ACLSeeder::class,
            RestaurantSeeder::class,
            CategorySeeder::class,
            ReservationSeeder::class,
            ContactSeeder::class,
            AddonGroupSeeder::class,
            ItemSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
