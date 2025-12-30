<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourCategory extends Model
{
    //
    protected $table = "tour_category";

    protected $fillable = [
        'name',
        'image',
        'description',
        'slug'
    ];
    // One category has many tours
   public function tours()
    {
        return $this->hasMany(Tour::class, 'category_id', 'id');
    }

}
