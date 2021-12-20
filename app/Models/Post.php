<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function activeComments()
    {
        return Comment::wherePostId($this->id)->whereDisabled('f')->get();
    }

    public function countComments()
    {
        return Comment::wherePostId($this->id)->count();
    }
}
