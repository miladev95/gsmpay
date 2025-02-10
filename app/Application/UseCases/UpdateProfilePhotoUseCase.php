<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;

class UpdateProfilePhotoUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(int $userId, string $profilePhotoPath)
    {
        return $this->userRepository->updateProfilePhoto($userId, $profilePhotoPath);
    }
}
