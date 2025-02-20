<?php

namespace App\Interfaces\Controllers;

use App\Application\UseCases\CreatePostUseCase;
use App\Application\UseCases\GetUserPostsUseCase;
use App\Application\UseCases\ShowPostUseCase;
use App\Application\UseCases\VisitPostUseCase;
use App\Helpers\ResponseHelper;
use App\Interfaces\Requests\CreatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController
{
    public function __construct(
        private CreatePostUseCase       $createPostUseCase,
        private GetUserPostsUseCase $getUserPostsUseCase,
        private VisitPostUseCase        $visitPostUseCase,
        private ShowPostUseCase        $showPostUseCase,
    )
    {
    }

    public function store(CreatePostRequest $request): JsonResponse
    {
        $userId = auth()->id();
        $post = $this->createPostUseCase->execute($request->title, $request->text, $userId);

        return ResponseHelper::success(['post' => $post], 201);
    }

    public function getUserPosts(Request $request): JsonResponse
    {
        $userId = auth()->id();
        $perPage = $request->input('perPage', 10);
        $posts = $this->getUserPostsUseCase->execute($userId,$perPage);
        return ResponseHelper::success($posts);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $this->visitPostUseCase->execute($id, $request->ip());
        $post = $this->showPostUseCase->execute($id);

        if (!$post) {
            return ResponseHelper::error('Post not found', 404);
        }

        return ResponseHelper::success($post);
    }
}
