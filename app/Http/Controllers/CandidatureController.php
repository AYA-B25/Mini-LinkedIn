<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatureController extends Controller
{
    public function index()
    {
        return Candidature::where('user_id', Auth::id())->paginate(10);
    }

    public function store(Request $request)
    {
        $candidature = Candidature::create([
            'user_id' => Auth::id(),
            'offre_id' => $request->offre_id,
            'message' => $request->message,
            'statut' => 'en_attente',
        ]);

        return response()->json($candidature);
    }

    public function show(Candidature $candidature)
    {
        if ($candidature->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($candidature);
    }

    public function update(Request $request, Candidature $candidature)
    {
        if ($candidature->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $candidature->update($request->all());

        return response()->json($candidature);
    }

    public function destroy(Candidature $candidature)
    {
        if ($candidature->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $candidature->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
