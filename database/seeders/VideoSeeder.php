<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        // Get all users or create a default user if none exists
        $users = User::all();
        if ($users->isEmpty()) {
            $users = collect([User::factory()->create()]);
        }

        // Sample video titles
        $titles = [
            'Amazing Sunset at the Beach',
            'City Life - A Day in New York',
            'Mountain Hiking Adventure',
            'Cooking Italian Pasta',
            'Travel Vlog: Tokyo Streets',
            'Music Festival Highlights',
            'Wildlife Documentary',
            'Tech Review: Latest Smartphone',
            'Fitness Workout Routine',
            'Art Tutorial: Watercolor Painting',
            'Coding Tutorial: Laravel Basics',
            'Photography Tips and Tricks',
            'Gaming Highlights: Best Moments',
            'DIY Home Decoration Ideas',
            'Cooking Masterclass: French Cuisine'
        ];

        // Create 15 sample videos
        for ($i = 0; $i < 15; $i++) {
            $title = $titles[$i];
            $user = $users->random();
            $visibility = ['public', 'private', 'unlisted'][array_rand(['public', 'private', 'unlisted'])];

            // Create video record
            Video::create([
                'title' => $title,
                'file_path' => 'videos/sample_video' . ($i % 3 + 1) . '.mp4',
                'thumbnail_path' => 'thumbnails/thumbnail' . ($i % 3 + 1) . '.jpg',
                'user_id' => $user->id,
                'visibility' => $visibility,
                'views' => rand(0, 10000),
                'likes' => rand(0, 1000)
            ]);
        }
    }
}
