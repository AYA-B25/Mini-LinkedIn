<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\CandidatureDeposee;
use App\Events\StatutCandidatureMis;
use App\Listeners\LogCandidatureDeposee;
use App\Listeners\LogStatutCandidature;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        

        StatutCandidatureMis::class => [
            LogStatutCandidature::class,
        ],
    ];
}
