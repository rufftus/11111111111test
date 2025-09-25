<?php

use App\Http\Controllers\VisiteurController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');});

Route::post('/verifierConnexion',[VisiteurController::class,'auth']);

Route::get('/connexion', function () {return view('login');});

//Route::get('/deconnecter', function () {return view('home');});

Route::get('/deconnecter',[VisiteurController::class,'logout']);
