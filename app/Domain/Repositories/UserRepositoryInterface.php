<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function create(User $user): User;
    public function findByUsername(string $username): ?User;
}
