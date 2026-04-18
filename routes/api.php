<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\CandidatureController;

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
