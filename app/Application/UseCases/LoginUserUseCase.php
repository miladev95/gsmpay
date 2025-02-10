<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(string $username, string $password)
    {
        $user = $this->userRepository->findByUsername($username);

        if (!$user || !Hash::check($password, $user->password)) {
            return null; // Authentication failed
        }

        return $user->createToken('auth_token')->plainTextToken;
    }
}
