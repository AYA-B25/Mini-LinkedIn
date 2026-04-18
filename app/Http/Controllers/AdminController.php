<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        return User::paginate(10);
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }

    public function offres()
    {
        return Offre::latest()->paginate(10);
    }

    public function toggleOffre(Offre $offre)
    {
        $offre->actif = !$offre->actif;
        $offre->save();

        return response()->json([
            'message' => 'Offre updated',
            'actif' => $offre->actif
        ]);
    }
}
