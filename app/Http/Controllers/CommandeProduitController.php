<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CommandeProduit;
use App\Models\Commande;
use App\Models\Produits;

class CommandeProduitController extends Controller
{
    public function index()
    {
        $commandeproduits = CommandeProduit::with('commande', 'produit')->get();
        $commandes = Commande::get();
        $produits = Produits::get();

        return response()->json([
            'commandeproduits' => $commandeproduits,
            'commandes' => $commandes,
            'produits' => $produits,
        ]);
    }
    public function show($id)
    {
        $commandeproduit = CommandeProduit::with('commande', 'produit')->find($id);

        if (!$commandeproduit) {
            return response()->json(['error' => 'Produit dans la commande non trouvé'], 404);
        }

        return response()->json([
            'commandeproduit' => $commandeproduit,
        ]);
    }

    public function add()
    {
        $commandes = Commande::get();
        $produits = produits::get();

        return response()->json([
            'commandes' => $commandes,
            'produits' => $produits,
        ]);
    }
    public function storel(Request $request)
    {
        $validatedData = $request->validate([
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'commande_id' => 'required|exists:commandes,id',
            'produit_id' => 'required|exists:produits,id',
        ]);

        // Créer un enregistrement dans la table pivot CommandeProduit
        $commandeProduit = CommandeProduit::create($validatedData);

        // Mettre à jour la quantité du produit
        $produit = Produits::find($validatedData['produit_id']);

        if ($produit) {
            if ($produit->qte >= $validatedData['quantite']) {
                $produit->decrement('qte', $validatedData['quantite']);
            } else {
                return response()->json(['error' => 'La quantité demandée est supérieure au stock'], 400);
            }
        }

        return response()->json(['message' => 'Commande produit ajouté avec succès']);
    }

    public function store(Request $request)
    {
        $commandeproduit = new CommandeProduit();

        $commandeproduit->quantite = $request->input('quantite');
        $commandeproduit->prix = $request->input('prix');
        $commandeproduit->commande_id = $request->input('commande_id');
        $commandeproduit->produit_id = $request->input('produit_id');

        $commandeproduit->save();

        // Update produit quantity
        $quantite = $request->input('quantite');
        $produit_id = $request->input('produit_id');
        $produit = produits::find($produit_id);

        if ($produit && $produit->qte >= $quantite) {
            $produit->decrement('qte', $quantite);
        } else {
            return response()->json(['error' => 'La quantité demandée est supérieure au stock'], 400);
        }

        return response()->json(['message' => 'Commande produit ajouté avec succès']);
    }

    public function edit($id)
    {
        $commandeproduit = CommandeProduit::find($id);
        $commandes = Commande::get();
        $produits = produits::get();

        return response()->json([
            'commandeproduit' => $commandeproduit,
            'commandes' => $commandes,
            'produits' => $produits,
        ]);
    }

    public function update($id, Request $request)
    {
        $commandeproduit = CommandeProduit::find($id);

        if (!$commandeproduit) {
            return response()->json(['error' => 'Commande produit non trouvé'], 404);
        }

        $commandeproduit->quantite = $request->input('quantite');
        $commandeproduit->prix = $request->input('prix');
        $commandeproduit->commande_id = $request->input('commande_id');
        $commandeproduit->produit_id = $request->input('produit_id');

        $commandeproduit->save();

        return response()->json(['message' => 'Commande produit mis à jour avec succès']);
    }

    public function delete($id)
    {
        $commandeproduit = CommandeProduit::find($id);

        if (!$commandeproduit) {
            return response()->json(['error' => 'Commande produit non trouvé'], 404);
        }

        $commandeproduit->delete();

        return response()->json(['message' => 'Commande produit supprimé avec succès']);
    }
}
