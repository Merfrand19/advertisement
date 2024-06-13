<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::all();
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|string|max:255',
            'date_de_debut' => 'date',
            'date_de_fin' => 'required|date',
            'url' => 'required|string|max:255',
        ]);

        $article = Article::create($validatedData);
        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'titre' => 'string|max:255',
            'description' => 'string',
            'image_url' => 'string|max:255',
            'date_de_debut' => 'date',
            'date_de_fin' => 'date',
            'url' => 'string|max:255',
        ]);

        $article->update($validatedData);
        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
