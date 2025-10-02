<?php

namespace App\Service;

use App\Models\Visiteur;  // Ton modèle Visiteur
use Illuminate\Support\Facades\Session;



class VisiteurService
{
    public function signIn($login, $mdp)
    {
        try {
            $visiteur = Visiteur::where('login_visiteur', $login)->first();

            if ($visiteur && $visiteur->pwd_visiteur === $mdp) {  // Ici tu compares en clair, à adapter pour hash
                Session::put('id_visiteur', $visiteur->id_visiteur);
                Session::put('visiteur', "$visiteur->prenom_visiteur $visiteur->nom_visiteur");
                return true;
            }
            return false;
        }
        catch (\Exception $exception)
        {
            return view('errors',compact('exception'));
        }
    }

    public function signOut()
    {
        try {
            Session::forget('id_visiteur');
        }
        catch (\Exception $exception)
        {
            return view('errors',compact('exception'));
        }

        }
}
