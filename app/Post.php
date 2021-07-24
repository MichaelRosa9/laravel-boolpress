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
        'category_id',
        'cover',
        'cover_original_name'
    ];

    
    public function category(){/* this function makes the connection with the model Category */
        return $this->belongsTo('App\Category');
    }
    
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
