<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = category::get();
        return response()->json([
            'status' => true,
            'message' => "index page!",
            'category' => $categories,

        ],200);        }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        category::create(['name' => $request->name]);

        return response()->json(['message' => 'Catégorie créée avec succès'], 201);
    }

    public function show($id)
    {
        $category = category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "index page!",
            'category' => $category,

        ],200);      }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        $category->update(['name' => $request->name]);


        return response()->json([
            'status' => true,
            'message' => 'category updated successfully.',
            'category' => $category,
        ], 200);    }

    public function destroy($id)
    {
        $category = category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès'], 200);
    }
}
