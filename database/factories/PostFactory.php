<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Eloquent\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infrastructure\Persistence\Eloquent\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post ::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph(5),
            'visit_count' => $this->faker->numberBetween(0, 100), // Random visit count
        ];
    }
}
