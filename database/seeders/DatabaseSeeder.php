<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StoreSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        // Create a demo user
        User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'is_superadmin' => false,
        ]);
    }
}
