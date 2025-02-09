<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Post;
use App\Infrastructure\Persistence\Eloquent\PostVisit;
use Illuminate\Database\Seeder;

class PostVisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Loop through all posts and create visits for them
        Post::all()->each(function ($post) {
            // Create random visits for each post
            // Ensure unique IP addresses for each post (5 visits per post)
            $visits = collect();

            while ($visits->count() < 5) {
                $ipAddress = fake()->unique()->ipv4;

                // Avoid duplicates for the same post and IP address
                if (!$visits->contains($ipAddress)) {
                    $visits->push($ipAddress);
                    PostVisit::create([
                        'post_id' => $post->id,
                        'ip_address' => $ipAddress
                    ]);
                }
            }
        });
    }
}
