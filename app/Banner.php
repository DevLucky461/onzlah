<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = [
        'banner_name',
        'banner_description',
        'banner_image_url',
    ];
}
