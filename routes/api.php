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
    ->name('login');Route::get('/topSpecialites', [SpecialiteController::class, 'topSpecialitesAPI']);
Route::get('/praticiens/recherche', [PraticienController::class, 'rechercheAPI']);
Route::get('/invitations', [InviterController::class, 'listInviterAPI']);
Route::post('/invitations/ajouter', [InviterController::class, 'addInviterAPI']);
Route::post('/invitations/modifier', [InviterController::class, 'updateInviterAPI']);
Route::delete('/invitations/supprimer/{id_activite}/{id_praticien}', [InviterController::class, 'removeInviterAPI']);
