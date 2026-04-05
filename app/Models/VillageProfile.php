<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'village_name',
        'hero_title',
        'hero_description',
        'about',
        'history',
        'identity',
        'vision',
        'mission',
        'address',
        'email',
        'phone',
        'google_maps_embed',
        'map_embed',
        'map_image',
        'hero_image',
    ];
}