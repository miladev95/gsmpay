<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\PostRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\PostVisitModel;

class VisitPostUseCase
{
    public function __construct(private PostRepositoryInterface $postRepository) {}

    public function execute(int $postId, string $ipAddress)
    {
        $existingVisit = PostVisitModel::where('post_id', $postId)->where('ip_address', $ipAddress)->first();

        if (!$existingVisit) {
            PostVisitModel::create(['post_id' => $postId, 'ip_address' => $ipAddress]);
            $post = $this->postRepository->getPostById($postId);
            $post->increment('visit_count');
        }
    }
}
