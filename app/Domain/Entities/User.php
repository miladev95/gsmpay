<?php

namespace App\Domain\Entities;

class User
{
    public function __construct(
        public string $username,
        public string $password,
        public ?string $profile_photo = null
    ) {}
}
