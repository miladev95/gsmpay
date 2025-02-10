<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\PostModel;
use App\Infrastructure\Persistence\Eloquent\UserModel;
use Database\Factories\PostModelFactory;
use Database\Factories\UserModelFactory;
use Illuminate\Database\Seeder;

class UserPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserModel::factory(10)->create()->each(function ($user) {
            PostModel::factory(5)->create(['user_id' => $user->id]);
        });
    }
}
