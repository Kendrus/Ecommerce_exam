<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Produit;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id', 'numero', 'date_commande','etat','paiement'];

    // Relation vers le client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Relation vers les produits (à adapter selon votre besoin)
    public function produits()
    {
        return $this->belongsToMany(produits::class);
    }

    // Méthode pour calculer le total (si nécessaire)
    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->produits as $produit) {
            $total += $produit->pivot->quantite * $produit->pivot->prix;
        }
        return $total;
    }
}
