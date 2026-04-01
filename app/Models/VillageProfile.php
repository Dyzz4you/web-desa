<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    protected $fillable = [
        'village_name',
        'hero_title',
        'hero_description',
        'about',
        'vision',
        'mission',
        'address',
        'email',
        'phone',
        'google_maps_embed',
        'hero_image',
    ];
}
