<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Standard User',
            'email' => 'user!@gmail.com',
            'password' => '123456',
            'role' => 'customer'
        ]);

        \App\Models\Service::create(['name' => 'Hair Cut', 'price' => 25.00, 'duration' => 30]);
        \App\Models\Service::create(['name' => 'Hair Coloring', 'price' => 80.00, 'duration' => 90]);
        \App\Models\Service::create(['name' => 'Facial', 'price' => 50.00, 'duration' => 60]);
        \App\Models\Service::create(['name' => 'Manicure', 'price' => 20.00, 'duration' => 30]);
    }
}
