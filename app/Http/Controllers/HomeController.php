<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\questions;
use App\Models\reponses;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $questions = questions::get();


        return response()->json([
            'status' => true,
            'message' => "index page!",
            'questions' => $questions,

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = auth()->user();

        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'theme' => 'required',
        ]);
        $question = new questions([
            'titre' => $request->get('titre'),
            'contenu' => $request->get('contenu'),
            'theme' => $request->get('theme'),
            'auteur' =>  $user->name,
            //auth()->user()->name,
            'date_creation' => now(),
        ]);

        $question->save();
        return response()->json([
            'status' => true,
            'message' => "question successfully!",
            'questions' => $question
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        //
        $question = questions::find($id);

        return response()->json([
            'status' => true,
            'message' => "index page!",
            'questions' => $question,

        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
