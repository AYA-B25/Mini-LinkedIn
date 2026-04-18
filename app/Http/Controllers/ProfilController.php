<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Competence;


class ProfilController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->profil) {
            return response()->json(['message' => 'Profil déjà existant'], 409);
        }
        
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'localisation' => 'nullable|string',
            'disponible' => 'nullable|boolean'
        ]);

        $profil = Profil::create([
            ...$data,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Profil créé avec succès',
            'profil' => $profil,
        ],201);
    }

    public function show()
    {
        $profil = $this->getProfil();

        $profil->load('competences');
        
        return response()->json([
            'profil' => $profil
            ],200);
    }

    public function update(Request $request)
    {
        $profil = auth()->user()->profil;
        if(!$profil)
        {
            return response()->json([
                'message' => "Profil introuvable",
            ],404);
        }

        $validated_profil = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'bio' => 'sometimes|string',
            'localisation' => 'sometimes|string',
            'disponible' => 'sometimes|boolean'
        ]);
        
        $profil->update($validated_profil);
        
        return response()->json([
            'profil' => $profil,
        ],200);
    }

    public function addCompetence(Request $request)
    {
        $profil = $this->getProfil();

        $request->validate([
            'competence_id' => 'required|exists:competences,id',
            'niveau' => 'required|in:debutant,intermediaire,expert',
        ]);

        $competence = Competence::find($request->competence_id);

        if($profil->competences()->where('competence_id',$competence->id)->exists()){
            return response()->json([
                'message' => 'Compétence déjà ajouté'
            ],409);
        }

        $profil->competences()->attach($competence->id,[
            'niveau' => $request->niveau]);

        return response()->json(['message' => 'Compétence ajoutée'], 201);    

    }
    public function removeCompetence(Competence $competence)
    {
        $profil = $this->getProfil();
        
        if(! $profil->competences()->where('competence_id',$competence->id)->exists()){
            return response()->json(['message'=>'Compétence introuvable dans votre profil'],404);
        }

        $profil->competences()->detach($competence->id);

        return response()->json(['message' => 'Compétence supprimée avec succès'],204);

    }
    private function getProfil()
    {
        if(!$profil = auth()->user()->profil) {
           
            return response()->json([
                'message' => "Profil introuvable",
            ],404);
        }
        return $profil;
    }
}
