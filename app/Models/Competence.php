<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profil;

class Competence extends Model
{
    protected $fillable=['nom','categorie'];

    public function profils()
    {
        return $this->belongsToMany(Profil::class);
    }
}
