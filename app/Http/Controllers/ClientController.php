<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Genre;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::get();


        return response()->json([
            'status' => true,
            'message' => "index page!",
            'clients' => $clients,

        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'telephone' => 'required',
            'sexe' => 'required',
        ]);

        $client = Client::create($validatedData);

        return response()->json(['message' => 'Client created successfully', 'data' => $client], 201);
    }

    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }


        return response()->json([
            'status' => true,
            'message' => "index page!",
            'client' => $client,

        ],200);    }


        public function generateAllClientsPdf()
        {
            $clients = Client::all();
    
            // Génération du contenu du PDF
            $pdf = PDF::loadView('clients.all-pdf', ['clients' => $clients]);
    
            // Enregistrement ou téléchargement du PDF
            // Vous pouvez également utiliser 'stream' pour afficher directement dans le navigateur
            return $pdf->download('clients_all.pdf');
        }
    

    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'telephone' => 'required',
            'sexe' => 'required',
        ]);

        $client->update($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'client updated successfully.',
            'client' => $client,
        ], 200);    }

    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client deleted successfully'], 200);
    }


}
