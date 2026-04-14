<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profil extends Model
{
    protected $fillable=['titre','bio','localisation','disponible'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
