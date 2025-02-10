<?php

namespace App\Interfaces\Controllers;

use App\Application\UseCases\AuthenticateUserUseCase;
use App\Interfaces\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController
{
    public function __construct(private AuthenticateUserUseCase $authenticateUserUseCase) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->authenticateUserUseCase->execute($request['username'], $request['password']);

        if (!$token) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token]);
    }
}
