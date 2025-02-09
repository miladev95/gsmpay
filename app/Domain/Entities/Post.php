<?php

namespace App\Domain\Entities;

class Post
{
    public function __construct(
        public string $title,
        public string $text,
        public int $visit_count,
        public int $author_id
    ) {}
}
