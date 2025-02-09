<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 users with random data
        User::factory(10)->create()->each(function ($user) {
            // Each user gets 5 posts
            Post::factory(5)->create(['user_id' => $user->id]);
        });
    }
}
