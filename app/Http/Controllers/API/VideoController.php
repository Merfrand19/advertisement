<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $videos= Video::all();
        return response()->json($videos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'date' => 'required|date',
            'remuneration' => 'required|numeric|min:0',
        ]);

        $video = Video::create($validatedData);
        // Déclenchez l'événement VideoUploaded
        //event(new VideoUploaded($video));
        return response()->json($video, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
        return response()->json($video);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        // Valider les données de la requête
        $validatedData = $request->validate([
            'nom' => 'string|max:255',
            'url' => 'string|max:255',
            'date' => 'date',
            'remuneration' => 'numeric|min:0',
        ]);

        // Mettre à jour les données de la vidéo
        $video->update($validatedData);

        // Retourner la vidéo mise à jour
        return response()->json($video, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // Supprimer la vidéo
        $video->delete();
        // Retourner une réponse avec le code 204 (No Content)
        return response()->json(null, 204);
    }
}
