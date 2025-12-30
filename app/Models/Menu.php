<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'group_id', 'title', 'url', 'sort_order', 'status'
    ];

    public function group()
    {
        return $this->belongsTo(MenuGroup::class, 'group_id');
    }
}
