<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Portefeuille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PortefeuilleController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $portefeuille = Portefeuille::where('user_id', $user->id)
        ->first();
        return response()->json($portefeuille);
    }

    public function update(Request $request)
    {
        Log::alert($request);
        $validatedData = $request->validate([
            'montant' => 'numeric|min:0',
        ]);
        $user = $request->user();
        $portefeuille = Portefeuille::where('user_id', $user->id)
        ->first();
        $portefeuille->montant += $validatedData["montant"];
        $portefeuille->save();
        return response()->json($portefeuille, 200);
    }
}
