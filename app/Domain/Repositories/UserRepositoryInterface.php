<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;
use App\Infrastructure\Persistence\Eloquent\UserModel;

interface UserRepositoryInterface
{
    public function create(User $user): User;
    public function findByUsername(string $username): ?UserModel;
}
