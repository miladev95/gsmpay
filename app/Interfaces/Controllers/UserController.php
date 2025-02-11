<?php

namespace App\Interfaces\Controllers;

use App\Application\UseCases\ListUsersByPostVisitsUseCase;
use App\Application\UseCases\UpdateProfilePhotoUseCase;
use App\Helpers\ResponseHelper;
use App\Interfaces\Requests\UpdateProfilePhotoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class UserController
{
    public function __construct(
        private ListUsersByPostVisitsUseCase $listUsersByPostVisitsUseCase,
        private UpdateProfilePhotoUseCase $updateProfilePhotoUseCase
    ) {}
    public function listUsersByPostVisits(Request $request): JsonResponse
    {
        $perPage = $request->input('perPage', 10);
        $users = $this->listUsersByPostVisitsUseCase->execute($perPage);
        return ResponseHelper::success($users);
    }

    public function updateProfilePhoto(UpdateProfilePhotoRequest $request): JsonResponse
    {
        $userId = auth()->id();
        $profilePhotoPath = $request->file('profile_photo')->store('profiles', 'public');

        $user = $this->updateProfilePhotoUseCase->execute($userId, $profilePhotoPath);
        return ResponseHelper::success($user);
    }
}
