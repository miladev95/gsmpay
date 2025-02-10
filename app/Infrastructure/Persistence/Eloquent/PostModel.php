<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Database\Factories\PostModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    use HasFactory;
    protected $fillable = ['title', 'text', 'visit_count', 'user_id'];

    public function visits()
    {
        return $this->hasMany(PostVisitModel::class);
    }

    protected static function newFactory()
    {
        return PostModelFactory::new();
    }
}
