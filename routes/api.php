<?php

use App\Interfaces\Controllers\AuthController;
use App\Interfaces\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Interfaces\Controllers\PostController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'getUserPosts']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::get('/users/by-post-visits', [UserController::class, 'listUsersByPostVisits']);
    Route::get('/user/update', [UserController::class, 'updateProfilePhoto']);
});
