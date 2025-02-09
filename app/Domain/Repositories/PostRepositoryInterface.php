<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Post;

interface PostRepositoryInterface
{
    public function getUserPosts(int $userId, int $perPage);
    public function getPostById(int $postId);
}
