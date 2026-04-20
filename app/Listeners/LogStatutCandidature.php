<?php

namespace App\Listeners;

use App\Events\StatutCandidatureMis;

class LogStatutCandidature
{
    public function handle(StatutCandidatureMis $event): void
    {
        $message = sprintf(
            "[%s] Candidature #%d mise à jour : %s → %s | candidat: %s | offre: %s\n",
            now(),
            $event->candidature->id,
            $event->ancienStatut,
            $event->nouveauStatut,
            $event->candidature->profil->user->name ?? 'N/A',
            $event->candidature->offre->titre ?? 'N/A'
        );

        file_put_contents(
            storage_path('logs/candidatures.log'),
            $message,
            FILE_APPEND
        );
    }
}
