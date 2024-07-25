<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;

class client extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom' ,
        'adresse',
        'telephone',
        'sexe' ,
    ];
    public function Commandes()
    {
        return $this->hasMany(Commande::class);
    }

}
