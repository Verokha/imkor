<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class CarItem extends Model
{
    use HasFactory, AsSource, Attachable;

    const CATEGORIES = [
        [
            'type' => 'all',
            'label' => 'Все',
        ],
        [
            'type' => 'own',
            'label' => 'Для себя',
        ],
        [
            'type' => 'family',
            'label' => 'Для семьи',
        ],
        [
            'type' => 'business',
            'label' => 'Для бизнеса',
        ],
    ];
    
    protected $fillable = [
        'title',
        'year',
        'milleage',
        'engine',
        'transmission',
        'drive_unit',
        'type',
        'url',
    ];
}
