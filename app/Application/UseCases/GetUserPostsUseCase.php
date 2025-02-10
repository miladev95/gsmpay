<?php

namespace App\Application\UseCases;

use App\Domain\Entities\Post;
use App\Domain\Repositories\PostRepositoryInterface;

class GetUserPostsUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository) {}

    public function execute(int $userId, int $perPage)
    {
        return $this->postRepository->getUserPosts($userId,$perPage);
    }
}
