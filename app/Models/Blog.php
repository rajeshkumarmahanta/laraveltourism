<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    
    protected $table = 'blogs'; // table name

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'status',
        'meta_keywords',
        'meta_description',
        'author',
        'short_description',
        'published_at',
        'tags',
    ];
}
