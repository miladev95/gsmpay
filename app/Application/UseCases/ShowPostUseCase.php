<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\PostRepositoryInterface;

class ShowPostUseCase
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(int $postId)
    {
        return $this->postRepository->getPostById($postId);
    }
}
