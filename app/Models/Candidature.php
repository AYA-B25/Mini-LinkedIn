<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidature extends Model
{
    protected $fillable = [
        'offre_id',
        'profil_id',
        'message',
        'statut'
    ];

    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }

    public function profil(): BelongsTo
    {
        return $this->belongsTo(Profil::class);
    }
    
}
