<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    protected $table = 'tours';
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
        'short_description',
        'price',
        'discount_price',
        'duration',
        'location',
        'featured_image',
        'status',
        'featured',
        'meta_keywords',
        'meta_description',
    ];
    // One category has many tours
    public function category(){
        return $this->belongsTo(TourCategory::class, 'category_id');
    }
     public function bookings()
    {
        return $this->hasMany(Booking::class, 'tour_id');
    }
}
