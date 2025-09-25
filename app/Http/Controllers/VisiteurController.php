<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\VisiteurService;

class VisiteurController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        $visiteur=new VisiteurService();
        $visiteur->signOut();
        return redirect(url('/'));
    }

    public function auth(Request $request)
    {
        $login = $request->input('login');
        $mdp = $request->input('mdp'); // correspond au champ name="mdp"

        $service = new VisiteurService();

        if ($service->signIn($login, $mdp)) {
            return redirect(url('/'));
        } else {
            $erreur = "Identifiant ou mot de passe incorrect";
            return view('login', compact('erreur'));
        }
    }
}
