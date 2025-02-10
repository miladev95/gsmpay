<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Eloquent\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => Hash::make('password'), // Default password
            'profile_photo' => $this->faker->imageUrl(100, 100, 'people'), // Fake profile photo
        ];
    }
}
