<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:candidat,recruteur'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return response()->json([
            'message' => 'Compte créé avec succès',
            'user' => $user,
        ],201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if(!$token=auth()->attempt($credentials))
        {    
            return respoonse()->json([
                'message' => 'Email ou  mot de passe incorrect',

            ],401);
        }

        return $this->respondWithToken($token);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Déconnexion réussie'
        ],200);
    }
    public function me()
    {
        return response()->json([auth()->user()]);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    private function respondWithToken(string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL()*60,
            'user' => auth()->user(),
        ]);
    }
}
