<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function index(Request $request)
    {
        $query = Offre::query();

        if ($request->localisation) {
            $query->where('localisation', $request->localisation);
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->sort == 'recent') {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate(10);
    }

    public function store(Request $request)
    {
        $offre = Offre::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'description' => $request->description,
            'localisation' => $request->localisation,
            'type' => $request->type,
            'actif' => true,
        ]);

        return response()->json($offre);
    }

    public function show(Offre $offre)
    {
        return response()->json($offre);
    }

    public function update(Request $request, Offre $offre)
    {
        if ($offre->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $offre->update($request->all());

        return response()->json($offre);
    }

    public function destroy(Offre $offre)
    {
        if ($offre->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $offre->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
