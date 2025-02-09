<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\PostRepositoryInterface;
use App\Domain\Entities\Post;
use App\Infrastructure\Persistence\Eloquent\PostModel;

class PostRepository implements PostRepositoryInterface
{
    public function create(Post $post): Post
    {
        $createdPost = PostModel::create([
            'title' => $post->title,
            'text' => $post->text,
            'visit_count' => $post->visit_count,
            'author_id' => $post->author_id,
        ]);

        return new Post($createdPost->title, $createdPost->text, $createdPost->visit_count, $createdPost->author_id);
    }

    public function getUserPosts(int $userId, int $perPage)
    {
        return PostModel::where('author_id', $userId)->paginate($perPage);
    }

    public function getPostById(int $postId)
    {
        return PostModel::find($postId);
    }
}
