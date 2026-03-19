<?php

namespace App\Http\Controllers;

use App\Models\Activite_compl;
use App\Models\Inviter;
use App\Service\FraisService;
use Illuminate\Http\Request;
use App\Models\Praticien;
use App\Service\PraticienService;


class PraticienController extends Controller
{
    public function practiceA()
    {
        try {
            $services = new PraticienService();
            $fiches = $services->getListPracticien();
            return view('listPraticien', compact('fiches'));
        } catch (\Exception $exception) {
            return view('error', compact('exception'));
        }

    }

    public function index(Request $request)
    {
        $query = $request->input('laRecherche');

        if ($query) {
            $praticiens = Praticien::where('nom_praticien', 'LIKE', "%{$query}%")
                ->orWhere('prenom_praticien', 'LIKE', "%{$query}%")
                ->get();
        } else {
            $praticiens = collect();
        }

        return view('recherche', compact('praticiens', 'query'));
    }


    public function addInviter()
    {
        try {
            $inviter = new Inviter();
            $activite_compl=[new Activite_compl()];
            return view('formInvitation', compact('inviter','activite_compl'));
        }

        catch (\Exception $exception)
        {
            return view('error',compact('exception'));
        }
    }

    public function validInviter(Request $request) {
        try {
            $service = new PraticienService();

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
