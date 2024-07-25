<?php

// app/Models/ProduitStock.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitStock extends Model
{
    protected $table = 'produit_stock';

    protected $fillable = ['produit_id', 'quantite'];

    public function produit()
    {
        return $this->belongsTo(produits::class);
    }
}
