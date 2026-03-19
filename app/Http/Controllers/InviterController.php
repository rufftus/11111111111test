<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inviter;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Service\InviterService;

class InviterController extends Controller
{

    public function addFrais()
    {
        try {
            $frais = new Frais();
            $frais->anneemois = date("Y-m");

            $etats=[new Etat()];
            $etats[0]->lib_etat="Création en cours";

            return view('formFrais', compact('frais','etats'));
        }

        catch (\Exception $exception)
        {
            return view('error',compact('exception'));
        }

    }

    public function validFrais(Request $request) {
        try {
            $service = new FraisService();

            // Récupération ou création du frais
            $id_frais = $request->input('id');
            $frais = $id_frais ? $service->getFrais($id_frais) : new Frais();

            // Récupération de l'état, avec une valeur par défaut
            $id_etat = $request->input('etat');
            if (empty($id_etat)) {
                $id_etat = 2; // Par exemple : "Création en cours"
            }

            // Remplissage des données
            $frais->id_etat = $id_etat;
            $frais->id_visiteur = session('id_visiteur');
            $frais->titre=$request->input('titre');
            $frais->anneemois = $request->input('mois');
            $frais->nbjustificatifs = $request->input('nbjustif');
            $frais->montantvalide = $request->input('valide');
            $frais->datemodification = date('Y-m-d');

            // Sauvegarde
            $service->saveFrais($frais);

            return redirect(url('/listerFrais'));

        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }


    public function editFrais($id)
    {
        try {
            $service = new FraisService();
            $frais = $service->getFrais($id);

            $etats=$service->getListEtats();

            return view('formFrais', compact('frais','etats'));
        }
        catch (\Exception $exception)
        {
            $erreur=Session::get('erreur');
            Session::remove('erreur');
            return view('error',compact('exception'));
        }

    }

    public function removeFrais($id)
    {
        try
        {
            $service = new FraisService();
            $service->deleteFrais($id);
            return redirect(url('/listerFrais'));
        }
        catch (\Exception $exception)
        {
            if($exception->getCode()==23000)
            {
                Session::put('erreur',$exception->getUserMessage());
                return redirect(url('/editerFrais'.$id));
            }
            else
            {
                return view('error',compact('exception'));
            }
        }
    }
}
