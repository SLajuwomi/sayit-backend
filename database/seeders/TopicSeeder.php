<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Usually not needed for specific seeders

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Define an array of topic names to be seeded
        $topics = [
            ['name' => 'General'],
            ['name' => 'Technology'],
            ['name' => 'Random Thoughts'],
            ['name' => 'Laravel Development'],
            ['name' => 'React & TypeScript'],
        ];

        // Loop through the topics and create them if they don't exist
        foreach ($topics as $topic) {
            Topic::firstOrCreate($topic);
        }
    }
}