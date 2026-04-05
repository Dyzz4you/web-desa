<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'description',
        'file',
        'thumbnail',
        'type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}