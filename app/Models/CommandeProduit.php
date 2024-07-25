<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeProduit extends Model
{
    use HasFactory;

    protected $table = 'commande_produit';
    protected $fillable = ['quantite', 'prix', 'commande_id', 'produit_id'];

    // Relation vers la commande
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
     // Relation vers le produit
     public function produit()
     {
         return $this->belongsTo(produits::class, 'produit_id');
     }
}
