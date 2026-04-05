<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'total_population',
        'male_count',
        'female_count',
        'family_count',
        'birth_count',
        'death_count',
        'moved_in_count',
        'moved_out_count',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}