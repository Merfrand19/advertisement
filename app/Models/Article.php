<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'image_url',
        'date_de_debut',
        'date_de_fin',
        'url',
    ];

    protected $casts = [
        'date_de_debut' => 'date',
        'date_de_fin' => 'date',
    ];
}
