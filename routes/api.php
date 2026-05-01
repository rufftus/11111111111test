<?php

use App\Http\Controllers\VisiteurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\PraticienController;
use App\Http\Controllers\InviterController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('visiteur/initpwd',[VisiteurController::class,'initPasswordAPI']);

Route::post('visiteur/auth',[VisiteurController::class,'authAPI']);

Route::get('visiteur/logout',[VisiteurController::class,'logoutAPI'])
    ->middleware('auth:sanctum');

Route::get('visiteur/unauthorized',[VisiteurController::class,'unauthorizedAPI'])
    ->name('login');


// --- PRATICIENS ---
// Recherche par nom ou type
Route::get('/praticiens/search', [PraticienController::class, 'search']);
// Praticiens filtrés par spécialité
Route::get('/praticiens/specialite/{id}', [PraticienController::class, 'getBySpecialite']);

// --- SPECIALITES ---
// Liste de toutes les spécialités
Route::get('/specialites', [SpecialiteController::class, 'index']);
// Top 5 des spécialités (le plus d'invités)
Route::get('/specialites/top5', [SpecialiteController::class, 'top5']);

// --- INVITATIONS (Activités Complémentaires) ---
Route::get('/invitations', [InviterController::class, 'index']);
Route::post('/invitations', [InviterController::class, 'store']);
Route::put('/invitations/{id_activite}/{id_praticien}', [InviterController::class, 'update']);
Route::delete('/invitations/{id_activite}/{id_praticien}', [InviterController::class, 'destroy']);
