<?php

namespace App\Service;

use App\Models\Visiteur;  // Ton modèle Visiteur
use Illuminate\Support\Facades\Session;
use function Laravel\Prompts\password;


class VisiteurService
{
    public function signIn($login, $pwd)
    {
        try {
            $visiteur = Visiteur::query()->where('login_visiteur','=', $login)->first();

            if ($visiteur && password_verify($pwd,$visiteur->pwd_visiteur)) {  // Ici tu compares en clair, à adapter pour hash
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
