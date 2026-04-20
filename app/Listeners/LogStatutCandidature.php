<?php

namespace App\Listeners;

use App\Events\StatutCandidatureMis;
use Illuminate\Support\Facades\Log;

class LogStatutCandidature
{
    public function handle(StatutCandidatureMis $event): void
    {
        Log::channel('candidatures')->info('Statut candidature mis à jour', [
            'candidature_id' => $event->candidature->id,
            'candidat' => $event->candidature->profil->user->name ?? null,
            'offre' => $event->candidature->offre->titre ?? null,
            'ancien_statut' => $event->ancienStatut,
            'nouveau_statut' => $event->nouveauStatut,
            'date' => now()
        ]);
    }
}
