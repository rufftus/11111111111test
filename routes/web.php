<?php

use App\Http\Controllers\FraisHFController;
use App\Http\Controllers\InviterController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\FraisController;
use App\Http\Controllers\PraticienController;
use App\Http\Controllers\SpecialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');});

Route::post('/verifierConnexion',[VisiteurController::class,'auth']);

Route::get('/connexion', function () {return view('login');});

//Route::get('/deconnecter', function () {return view('home');});

Route::get('/deconnecter',[VisiteurController::class,'logout']);



Route::get('/listerFrais',[FraisController::class,'listFrais']);

Route::get('/ajouterFrais',[FraisController::class,'addFrais']);

Route::post('/validerFrais',[FraisController::class,'validFrais']);

Route::get('/editerFrais/{id}',[FraisController::class,'editFrais']);

Route::get('/supprimerFrais/{id}',[FraisController::class,'removeFrais']);



Route::get('/listerFraisHF/{id}',[FraisHFController::class,'listFraisHF']);

Route::get('/ajouterFraisHF/{id}',[FraisHFController::class,'addFraisHF']);

Route::get('/editerFraisHF/{id}',[FraisHFController::class,'editFraisHF']);

Route::post('validerFraisHF',[FraisHFController::class,'validFraisHF']);


Route::get('/practicienA',[PraticienController::class,'practiceA']);
Route::get('/practicienB',[SpecialiteController::class,'practiceB']);


Route::get('/recherche', [PraticienController::class, 'index'])->name('recherche.praticien');


Route::get('/ajouterInviter', [InviterController::class, 'addInviter'])->name('ajouter.inviter');
Route::post('/validerInviter', [InviterController::class, 'validInviter'])->name('valider.inviter');Route::get('/editerInviter/{id_activite}/{id_praticien}', [InviterController::class, 'editInviter']);
Route::get('/supprimerInviter/{id_activite}/{id_praticien}', [InviterController::class, 'removeInviter']);


