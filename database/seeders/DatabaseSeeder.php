<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Create a specific test user
        User::factory()->create([
            'screen_name' => 'TestUser', // Use screen_name
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // Ensure password is set if not handled by factory default
        ]);

        // Create 10 additional random users
        // User::factory(10)->create(); // This line can be uncommented if you want more random users

        // Call the TopicSeeder to populate topics
        $this->call([
            TopicSeeder::class,
            // You can add other seeders here in the future
        ]);
    }
}