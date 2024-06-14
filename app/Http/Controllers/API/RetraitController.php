<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Retrait;
use Illuminate\Http\Request;

class RetraitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = $request->user();
        $retraitEnCours = Retrait::where("user_id", $user->id)
->where("statut", "en cours")->first();
if($retraitEnCours) return response()->json("Vous avez déjà un retrait en cours", 401);
        $validatedData = $request->validate([
            'montant' => 'required|numeric|min:0',
        ]);

        if($validatedData["montant"] > $user->portefeuille->montant) return response()->json("Montant insuffisant", 401);
        $retrait = new Retrait();
        $retrait->user_id = $user->id;
        $retrait->montant = $validatedData["montant"];
        $user->portefeuille->montant -= $validatedData["montant"];
        $retrait->statut = "en cours";
        $retrait->save();
        $user->portefeuille->save();

        return response()->json($retrait, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Retrait $retrait)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Retrait $retrait)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Retrait $retrait)
    {
        //
    }
}
