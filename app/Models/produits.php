<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produits extends Model
{
    use HasFactory;
    protected $fillable = [

    'nom',
    'description' ,
    'category',
    'prix' ,
    'qte' ,

   
    'photo'    ];
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
                    ->using(CommandeProduit::class)
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }
}
