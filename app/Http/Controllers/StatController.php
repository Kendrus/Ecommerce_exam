<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produit;
use App\Models\produits;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function count()
    {
        $totalClients = Client::count();
  
        return response()->json([
            'status' => true,
            'message' => 'Nombre total de clients récupéré avec succès.',
            'reponses' => $totalClients,
        ], 200);
    }

    public function clientm()
    {
        $totalMen = Client::where('sexe', 'Masculin')->count();
   
        return response()->json([
            'status' => true,
            'message' => 'Nombre de clients masculins récupéré avec succès.',
            'reponses' => $totalMen,
        ], 200);
    }

    public function clientf()
    {
        $totalWomen = Client::where('sexe', 'Feminin')->count();
   
        return response()->json([
            'status' => true,
            'message' => 'Nombre de clients féminins récupéré avec succès.',
            'reponses' => $totalWomen,
        ], 200);
    }

    public function produit()
    {
        $totalProducts = produits::count();

        return response()->json([
            'status' => true,
            'message' => 'Nombre total de produits récupéré avec succès.',
            'reponses' => $totalProducts,
        ], 200);
    }
}
