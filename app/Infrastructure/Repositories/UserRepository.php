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

    public function findByUsername(string $username): ?UserModel
    {
        $user = UserModel::where('username', $username)->first();

        return $user;
    }

    public function getUsersOrderedByPostVisits(int $perPage)
    {
        return UserModel::withSum('posts', 'visit_count')
            ->orderByDesc('posts_sum_visit_count')
            ->paginate($perPage);
    }

    public function updateProfilePhoto(int $userId, string $profilePhotoPath)
    {
        $user = UserModel::findOrFail($userId);
        $user->profile_photo = $profilePhotoPath;
        $user->save();
        return $user;
    }
}
