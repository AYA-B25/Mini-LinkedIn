<?php

namespace App\Listeners;

use App\Events\CandidatureDeposee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogCandidatureDeposee
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CandidatureDeposee $event): void
    {
        $candidature = $event->candidature;
        $message = sprintf(
            "[%s] Candidature déposée par %s pour l'offre %s\n",
            now(),
            $candidature->profil->user->name,
            $candidature->offre->titre
        );

        // Écrire dans le fichier log
        file_put_contents(
            storage_path('logs/candidatures.log'),
            $message,
            FILE_APPEND
        );
    }
}
