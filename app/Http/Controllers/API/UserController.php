<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Portefeuille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function register(Request $request)
    {
        try {
            // Validation des données de la requête
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenoms' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);


            // Création de l'utilisateur
            $user = User::create([
                'nom' => $request->nom,
                'prenoms' => $request->prenoms,
                'email' => $request->email,
                'actif' => false,
                'password' => Hash::make($request->password),
            ]);
            $portefeuille = new Portefeuille();
            $portefeuille->user_id = $user->id;
            $portefeuille->montant = 0;

            $portefeuille->save();
            // Retourne la réponse avec l'utilisateur et le token
            return response()->json([
                "user" => $user,
                "token" => $user->createToken("token")->plainTextToken
            ], 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(["error" => $th->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $validated =  $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Log::info($validated);
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        // Récupère l'utilisateur authentifié
        $user = Auth::user();
        if ($user instanceof User) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token]);
        }

        return response()->json(['message' => 'Unable to generate token'], 500);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

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
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
