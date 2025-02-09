<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Entities\User;
use App\Infrastructure\Persistence\Eloquent\UserModel;


class UserRepository implements UserRepositoryInterface
{
    public function create(User $user): User
    {
        $createdUser = UserModel::create([
            'username' => $user->username,
            'password' => bcrypt($user->password),
            'profile_photo' => $user->profile_photo,
        ]);

        return new User($createdUser->username, $createdUser->password, $createdUser->profile_photo);
    }

    public function findByUsername(string $username): ?User
    {
        $user = UserModel::where('username', $username)->first();

        return $user ? new User($user->username, $user->password, $user->profile_photo) : null;
    }
}
