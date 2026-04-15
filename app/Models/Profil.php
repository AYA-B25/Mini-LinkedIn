<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Candidature;
use App\Models\Competence;
use App\Models\Offre;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profil extends Model
{
    protected $fillable = [
        'titre',
        'bio',
        'localisation',
        'disponible'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function candidatures():HasMany
    {
        return $this->hasMany(Candidature::class);
    }
    public function competences()
    {
        return $this->belongsToMany(Competence::class);
    }
}
