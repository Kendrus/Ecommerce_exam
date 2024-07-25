<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\produits;
use App\Models\category;
use App\Models\produit;
use App\Exports\ProduitsExport;
use Rap2hpoutre\FastExcel\FastExcel;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = produits::get();


        return response()->json([
            'status' => true,
            'message' => "index page!",
            'produits' => $produits,

        ], 200);
    }

    public function export()
{
    $data = produits::all();
    return (new FastExcel($data))->download('export.xlsx');
}


    public function show($id)
    {
        $produit = produits::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "index page!",
            'produits' => $produit,

        ],200);    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'id_category' => 'required',
            'prix' => 'required',
            'qte' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ajoutez des validations pour l'image si nécessaire
        ]);

        $produit = new produits();

        $produit->nom = $request->input('nom');
        $produit->description = $request->input('description');
        $produit->category = $request->input('id_category');
        $produit->prix = $request->input('prix');
        $produit->qte = $request->input('qte');

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $destinationPath = 'uploads/produits/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $produit->photo = $profileImage;
        }

        $produit->save();

        return response()->json(['message' => 'Produit créé avec succès', 'produits' => $produit], 201);
    }



    public function exportExcel()
    {
        $exporteur = new ProduitsExport();
        return $exporteur->exportToExcel();
    }


    public function update(Request $request, $id)
    {
    

        $produit = produits::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $produit->nom = $request->input('nom');
        $produit->description = $request->input('description');
        $produit->category = $request->input('category');
        $produit->prix = $request->input('prix');
        $produit->qte = $request->input('qte');

        if ($request->hasFile('photo')) {
               $image = $request->file('photo');
            $destinationPath = 'uploads/produits/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $produit->photo = $profileImage;
        }

        $produit->save();

        return response()->json([
            'status' => true,
            'message' => 'produit updated successfully.',
            'produits' => $produit,
        ], 200);    }

    public function destroy($id)
    {
        $produit = produits::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $produit->delete();

        return response()->json(['message' => 'Produit supprimé avec succès'], 200);
    }

    public function categories()
    {
        $categories = category::all();
        return response()->json(['data' => $categories]);
    }
}
