<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use App\Models\Client;
use App\Models\CommandeProduit;
use App\Models\produits;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('client')->get(); // Retourne uniquement les clients liés aux commandes
        $clients = Client::get();

        return response()->json([
            'commandes' => $commandes,
            'clients' => $clients,
        ]);
    }



    public function show($id)
    {
        // Récupérer la commande avec ses détails (y compris le client associé)
        $commande = Commande::with('client')->find($id);

        if (!$commande) {
            return response()->json(['error' => 'Commande not found'], 404);
        }

        // Récupérer les produits associés à cette commande
        $commandeproduits = CommandeProduit::where('commande_id', $id)
            ->with('produit') // Charger le produit associé à chaque ligne de commande
            ->get();

        // Calculer le montant total de la commande
        $total = 0;
        foreach ($commandeproduits as $commandeproduit) {
            $total += $commandeproduit->quantite * $commandeproduit->prix;
        }

        return response()->json([
            'commande' => $commande,
            'commandeproduits' => $commandeproduits,
            'total' => $total,
        ]);
    }
    public function store(Request $request)
    {
        $rand = Str::random(5);
        $gd = $rand . 'SEN';

        $data = [
            'client_id' => $request->client_id,
            'numero' => $gd,
            'date_commande' => $request->date_commande,
            'etat' => 'en cours',
            'paiement' => $request->paiement,

        ];

        $commande = Commande::create($data);

        return response()->json(['commande' => $commande], 201);
    }
    
    public function etat($id)
    {
        // Mettre à jour l'état de la commande
        Commande::find($id)->update(['etat' => 'terminée']);
    
        // Mettre à jour la quantité restante des produits associés à cette commande
        $commandeproduits = CommandeProduit::where('commande_id', $id)->get();
    
        foreach ($commandeproduits as $commandeproduit) {
            // Récupérer le produit associé
            $produit = produits::find($commandeproduit->produit_id);
    
            // Mettre à jour la quantité restante du produit
            $nouvelleQuantite = $produit->qte - $commandeproduit->quantite;
            $produit->update(['qte' => $nouvelleQuantite]);
        }
    
        return response()->json(['message' => 'Commande updated successfully']);
    }
    

    public function update($id, Request $request)
    {
        $data = [
            'client_id' => $request->client_id,
            'numero' => $request->numero,
            'date_commande' => $request->date_commande,
            'paiement' => $request->paiement,


        ];

        Commande::find($id)->update($data);

        return response()->json(['message' => 'Commande updated successfully']);
    }

    public function destroy($id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response()->json(['error' => 'Commande not found'], 404);
        }

        // Supprimer la commande
        $commande->delete();

        return response()->json(['message' => 'Commande deleted successfully']);
    }
}
