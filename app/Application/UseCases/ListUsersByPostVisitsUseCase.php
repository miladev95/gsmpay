<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;

class ListUsersByPostVisitsUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(int $perPage = 10)
    {
        return $this->userRepository->getUsersOrderedByPostVisits($perPage);
    }
}
