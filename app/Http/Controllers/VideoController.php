<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Video::all();
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

        return response()->json($video, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $video = Video::findOrFail($id);
        return response()->json($video);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom' => 'string|max:255',
            'url' => 'string|max:255',
            'date' => 'date',
            'remuneration' => 'numeric|min:0',
        ]);

        $video = Video::findOrFail($id);
        $video->update($validatedData);

        return response()->json($video, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $video = Video::findOrFail($id);
        $video->delete();
        return response()->json(null, 204);

    }
}
