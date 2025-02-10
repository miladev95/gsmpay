<?php

namespace App\Infrastructure\Persistence\Eloquent;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    protected $table = "users";
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected static function newFactory()
    {
        return UserModelFactory::new();
    }
}
