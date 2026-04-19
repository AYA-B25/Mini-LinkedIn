<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetenceProfil extends Model
{
    protected $fillable=['profil_id', 'competence_id','niveau'];
    public $timestamps = false;
}
