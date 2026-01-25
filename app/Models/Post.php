<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function post_tags()
    {
        return $this->belongsToMany('App\Models\Post_tag');
    }
    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }
    public function likedBy($user)
    {
        return Bookmark::where('user_id', $user->id)->where('post_id',$this->id);
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function getTagsList()
    {
        return $this->tags->pluck('tag_name')->implode(', ');
    }

}
