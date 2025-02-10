<?php

namespace App\Interfaces\Controllers;

use App\Application\UseCases\CreatePostUseCase;
use App\Domain\Repositories\PostRepositoryInterface;
use App\Interfaces\Requests\CreatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController
{
    public function __construct(
        private CreatePostUseCase $createPostUseCase,
        private PostRepositoryInterface $postRepository
    ) {}

    public function store(CreatePostRequest $request): JsonResponse
    {
        $userId = auth()->id();
        $post = $this->createPostUseCase->execute($request->title, $request->text, $userId);

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    public function getUserPosts(Request $request): JsonResponse
    {
        $userId = auth()->id();
        $perPage = $request->input('paginate', 10);
        $posts = $this->postRepository->getUserPosts($userId, $perPage);

        return response()->json($posts);
    }
}
