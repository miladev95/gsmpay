<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Eloquent\PostModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostModelFactory extends Factory
{
    protected $model = PostModel::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph(5),
            'visit_count' => $this->faker->numberBetween(0, 100), // Random visit count
        ];
    }
}
