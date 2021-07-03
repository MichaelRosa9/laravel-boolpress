<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /* variable required for the create and update function inside PostController */
    protected $fillable = [
        'title',
        'content',
        'slug',        

    ];
}
