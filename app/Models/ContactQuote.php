<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactQuote extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'ip_address'

    ];
}
