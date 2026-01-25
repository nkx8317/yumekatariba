<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    // use HasFactory;
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function likedBy($user)
    {
        return $this->where('user_id', $user->id)->where('post_id', $this->post_id)->exists();
    }

}
