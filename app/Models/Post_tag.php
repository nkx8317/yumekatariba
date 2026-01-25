<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_tag extends Model
{
    // use HasFactory;
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
