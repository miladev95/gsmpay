<?php

namespace App\Application\UseCases;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;

class RegisterUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(string $username, string $password, ?string $profilePhoto = null)
    {
        $user = new User($username, $password, $profilePhoto);
        return $this->userRepository->create($user);
    }
}
