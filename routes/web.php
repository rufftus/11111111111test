<?php

use App\Http\Controllers\FraisHFController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\FraisController;
use App\Http\Controllers\PraticienController;
use App\Http\Controllers\SpecialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');});
Route::post('/verifierConnexion',[VisiteurController::class,'auth']);
Route::get('/connexion', function () {return view('login');});
Route::get('/deconnecter',[VisiteurController::class,'logout']);

// Frais
Route::get('/listerFrais',[FraisController::class,'listFrais']);
Route::get('/ajouterFrais',[FraisController::class,'addFrais']);
Route::post('/validerFrais',[FraisController::class,'validFrais']);
Route::get('/editerFrais/{id}',[FraisController::class,'editFrais']);
Route::get('/supprimerFrais/{id}',[FraisController::class,'removeFrais']);

// Frais HF
Route::get('/listerFraisHF/{id}',[FraisHFController::class,'listFraisHF']);
Route::get('/ajouterFraisHF/{id}',[FraisHFController::class,'addFraisHF']);
Route::get('/editerFraisHF/{id}',[FraisHFController::class,'editFraisHF']);
Route::post('validerFraisHF',[FraisHFController::class,'validFraisHF']);

// Anciennes routes de test
Route::get('/practicienA',[PraticienController::class,'practiceA']);
Route::get('/practicienB',[SpecialiteController::class,'practiceB']);

use App\Http\Controllers\InvitationController;

// 1. Recherche d'un praticien (nom ou type)
Route::get('/praticiens/recherche', [PraticienController::class, 'recherche'])->name('praticiens.recherche');

// 3. Affichage des praticiens par spécialité
Route::get('/praticiens/specialite', [PraticienController::class, 'parSpecialite'])->name('praticiens.specialite');

// 4. Top 5 des spécialités
Route::get('/praticiens/top-specialites', [PraticienController::class, 'topSpecialites'])->name('praticiens.top');

// 2. Gestion des invitations (CRUD)
Route::get('/invitations/praticien/{id}', [InvitationController::class, 'index'])->name('invitations.index');
Route::get('/invitations/create/{id_praticien}', [InvitationController::class, 'create'])->name('invitations.create');
Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
Route::get('/invitations/{id_activite}/{id_praticien}/edit', [InvitationController::class, 'edit'])->name('invitations.edit');
Route::put('/invitations/{id_activite}/{id_praticien}', [InvitationController::class, 'update'])->name('invitations.update');
Route::delete('/invitations/{id_activite}/{id_praticien}', [InvitationController::class, 'destroy'])->name('invitations.destroy');
