<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class FaqItem extends Model
{
    use HasFactory, AsSource;

    const CACHE_KEY = 'faqItems';

    protected $fillable = [
        'question',
        'answer',
    ];
}
