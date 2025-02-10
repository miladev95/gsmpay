<?php

namespace App\Interfaces\Controllers;

use App\Application\UseCases\LoginUserUseCase;
use App\Application\UseCases\RegisterUserUseCase;
use App\Interfaces\Requests\LoginRequest;
use App\Interfaces\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController
{
    public function __construct(
        private LoginUserUseCase    $authenticateUserUseCase,
        private RegisterUserUseCase $registerUserUseCase
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->authenticateUserUseCase->execute($request['username'], $request['password']);

        if (!$token) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token]);
    }


    public function register(RegisterRequest $request): JsonResponse
    {
        $profilePhoto = $request->file('profile_photo')?->store('profiles', 'public');

        $user = $this->registerUserUseCase->execute(
            $request->username,
            $request->password,
            $profilePhoto
        );

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
}
