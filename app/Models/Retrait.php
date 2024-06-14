<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retrait extends Model
{
    use HasFactory;
    protected $table = "retraits";
    protected $fillable = [
        "user_id",
        "statut",
        "montant"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
