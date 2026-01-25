<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag_name'];
    public $timestamps = false;
    // use HasFactory;
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
    public function post_tags()
    {
        return $this->belongsToMany('App\Models\Post_tag');
    }
}
