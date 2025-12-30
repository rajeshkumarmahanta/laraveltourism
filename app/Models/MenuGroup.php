<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    //
     protected $fillable = ['group_name'];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'group_id')->orderBy('sort_order', 'ASC');
    }
}
