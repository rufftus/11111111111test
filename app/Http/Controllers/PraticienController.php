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
            return view(     'error', compact('exception'));
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







    public function searchAPI(Request $request)
    {
        $services = new PraticienService();
        $fiches = $services->getListPracticien();
        return json_encode($fiches);
    }






}
