<?php

namespace App\Application\UseCases;

use App\Domain\Entities\Post;
use App\Domain\Repositories\PostRepositoryInterface;

class CreatePostUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository) {}

    public function execute(string $title, string $text, int $authorId): Post
    {
        $post = new Post($title, $text, 0, $authorId);
        return $this->postRepository->create($post);
    }
}
