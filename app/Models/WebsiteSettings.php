<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSettings extends Model
{
    //
    protected $table = "website_settings";
    protected $fillable = [
        'site_name',
        'site_tagline',
        'logo',
        'favicon',

        'contact_email',
        'contact_phone',
        'contact_address',

        'facebook',
        'instagram',
        'twitter',
        'youtube',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'about_website',
    ];
}
