<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVisitModel extends Model
{
    use HasFactory;
    protected $table = 'post_visits';

    protected $fillable = ['post_id', 'ip_address'];

    public function post()
    {
        return $this->belongsTo(PostModel::class);
    }
}
