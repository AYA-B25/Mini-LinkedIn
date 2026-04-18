<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;

Route::post('/auth/register', [AuthController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::post('/auth/logout', [AuthController::class,'logout']);
    Route::post('/auth/refresh', [AuthController::class,'refresh']);
    Route::get('/auth/me', [AuthController::class,'me']);
});

Route::middleware(['auth:api','role:candidat'])->group(function () {
    Route::post('/profil',[ProfilController::class,'store']);
    Route::get('/profil',[ProfilController::class,'show']);
    Route::put('/profil',[ProfilController::class,'update']);
    Route::post('/profil/competences',[ProfilController::class,'addCompetence']);
    Route::delete('/profil/competences/{competence}',[ProfilController::class,'removeCompetence']);
});


Route::get('offres', [OffreController::class, 'index']);
Route::get('offres/{offre}', [OffreController::class, 'show']);

Route::middleware(['auth'])->group(function () {
    Route::post('offres', [OffreController::class, 'store']);
    Route::put('offres/{offre}', [OffreController::class, 'update']);
    Route::delete('offres/{offre}', [OffreController::class, 'destroy']);

    Route::apiResource('candidatures', CandidatureController::class);

    Route::middleware(['checkrole:admin'])->group(function () {
        Route::get('admin/users', [AdminController::class, 'users']);
        Route::delete('admin/users/{user}', [AdminController::class, 'deleteUser']);
        Route::get('admin/offres', [AdminController::class, 'offres']);
        Route::patch('admin/offres/{offre}/toggle', [AdminController::class, 'toggleOffre']);
    });
});
