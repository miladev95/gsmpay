<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'text', 'visit_count', 'user_id'];

    public function visits()
    {
        return $this->hasMany(PostVisit::class);
    }
}
