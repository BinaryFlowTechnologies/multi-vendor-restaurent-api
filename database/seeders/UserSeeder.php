<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $user = User::query()->create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'phone'    => '1234567890',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserAddress::factory()->count(2)->state([
            'user_id' => $user->id
        ])->create();

        User::factory()->count(50)->afterCreating(function($user) {
            UserAddress::factory()->count(2)->state([
                'user_id' => $user->id
            ])->create();
        })
            ->create()
        ;
    }
}
