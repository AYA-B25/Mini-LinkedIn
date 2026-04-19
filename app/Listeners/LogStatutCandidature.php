<?php

namespace App\Listeners;

use App\Events\StatutCandidatureMis;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogStatutCandidature
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
    public function handle(StatutCandidatureMis $event): void
    {
        Log::info('Statut candidature mis à jour', [
            'candidature' => $event->candidature
        ]);
    }
}
