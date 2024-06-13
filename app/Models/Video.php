<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'url',
        'date',
        'remuneration',
    ];

    protected $casts = [
        'date' => 'date',
        'remuneration' => 'decimal:2',
    ];
}
