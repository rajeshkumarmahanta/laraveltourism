<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'tour_id',
        'name',
        'email',
        'phone',
        'travel_date',
        'travenlers_no',
        'pickup_address',
        'id_type',
        'price',
        'id_image',
        'additional_message',
    ];
    public function tour()
        {
            return $this->belongsTo(Tour::class, 'tour_id');
        }

}
