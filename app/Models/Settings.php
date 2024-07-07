<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    const array CURRENT_SETTINGS = ['home_settings', 'seo', 'advantages'];

    protected $fillable = [
        'tech_name',
        'data',
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
