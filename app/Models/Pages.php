<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    //
    protected $table = 'pages';

    protected $fillable = [
        'name',
        'title',
        'slug',
        'status',
        'short_description',
        'description',
        'image',
        'meta_keywords',
        'meta_description',
    ];
}
