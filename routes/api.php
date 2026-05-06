<?php

use App\Http\Controllers\VisiteurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\PraticienController;
use App\Http\Controllers\InvitationController;

// --- AUTHENTIFICATION ---
Route::post('visiteur/auth', [VisiteurController::class, 'authAPI']);
Route::post('visiteur/initpwd', [VisiteurController::class, 'initPasswordAPI']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('visiteur/logout', [VisiteurController::class, 'logoutAPI']);

    // --- MISSION 7 : PRATICIENS ---
    // Fonctionnalité 1 : Recherche par nom ou type
    Route::get('/praticiens/recherche', [PraticienController::class, 'apiRecherche']);
    Route::get('/praticiens/types', [PraticienController::class, 'getTypes']);

    // Fonctionnalité 3 : Filtre par spécialité[cite: 2]
    Route::get('/specialites', [SpecialiteController::class, 'index']);
    Route::get('/praticiens/specialite/{id}', [PraticienController::class, 'apiBySpecialite']);

    // Fonctionnalité 4 : Top 5 des spécialités[cite: 2]
    Route::get('/praticiens/top-specialites', [PraticienController::class, 'apiTopSpecialites']);

    // --- MISSION 7 : GESTION DES INVITATIONS (CRUD) ---
    // Fonctionnalité 2 : Liste, Ajout et Suppression d'invitations[cite: 2]
    Route::get('/activites', [InvitationController::class, 'getActivites']);
    Route::get('/invitations/praticien/{id}', [InvitationController::class, 'apiIndex']);
    Route::post('/invitations', [InvitationController::class, 'store']); // Pour l'ajout via React
    Route::delete('/invitations/{idActivite}/{idPraticien}', [InvitationController::class, 'destroy']);
    Route::put('/invitations/{idActivite}/{idPraticien}', [InvitationController::class, 'update']);
});

Route::get('visiteur/unauthorized', [VisiteurController::class, 'unauthorizedAPI'])->name('login');
