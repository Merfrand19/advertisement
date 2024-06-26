<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portefeuille extends Model
{
    use HasFactory;
    protected $table = "portefeuilles";
    protected $fillable = [
        "user_id",
        "montant"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
