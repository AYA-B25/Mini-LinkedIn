<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;     
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\StatutCandidatureMis;
use App\Events\CandidatureDeposee;

class CandidatureController extends Controller
{
    public function index()
    {
        return Candidature::where('user_id', Auth::id())
            ->paginate(10);
    }

    public function store(Request $request,$offre_id)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $candidature = Candidature::create([
            'user_id' => Auth::id(),
            'offre_id' => $offre_id,
            'profil_id' => Auth::id(),
            'message' => $request->message,
            'statut' => 'en_attente',
        ]);

        event(new CandidatureDeposee($candidature));

        return response()->json($candidature);
    }
    

    public function getCandidatures(Offre $offre)
    {
        
        if (auth()->id() !== $offre->user_id) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $candidatures = $offre->candidatures()
                            ->with(['profil.user', 'profil.competences'])
                            ->get();

        return response()->json($candidatures);
    }

    public function updateStatut(Request $request, Candidature $candidature)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,acceptee,refusee'
        ]);

        if ($candidature->offre->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $ancienStatut = $candidature->statut;

        $candidature->update([
            'statut' => $request->statut
        ]);

        event(new StatutCandidatureMis(
            $candidature,
            $ancienStatut,
            $request->statut
        ));

        return response()->json([
            'message' => 'Statut mis à jour',
            'candidature' => $candidature
        ]);
    }
}
