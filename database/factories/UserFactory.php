<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Eloquent\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infrastructure\Persistence\Eloquent\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => Hash::make('password'), // Default password
            'profile_photo' => $this->faker->imageUrl(100, 100, 'people'), // Fake profile photo
        ];
    }
}
