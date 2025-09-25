<?php

namespace App\Service;

use App\Models\Visiteur;  // Ton modèle Visiteur
use Illuminate\Support\Facades\Session;



class VisiteurService
{
    public function signIn($login, $mdp)
    {
        $visiteur = Visiteur::where('login_visiteur', $login)->first();

        if ($visiteur && $visiteur->pwd_visiteur === $mdp) {  // Ici tu compares en clair, à adapter pour hash
            Session::put('id_visiteur', $visiteur->id_visiteur);
            return true;
        }
        return false;
    }

    public function signOut()
    {
        Session::forget('id_visiteur');
    }
}
