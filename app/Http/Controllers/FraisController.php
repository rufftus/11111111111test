<?php

namespace App\Http\Controllers;

use App\Models\Frais;
use App\Service\FraisService;
use Illuminate\Http\Request;


class FraisController extends Controller
{
    public function listFrais()
    {
        $services = new FraisService();
        $id_visiteur= session('id_visiteur');
        $fiches=$services->getListFrais($id_visiteur);
        return view('listFrais',compact('fiches'));
    }



    public function addFrais()
    {
        $frais=new Frais();
        $frais->anneemois=date("Y-m");
        return view('formFrais',compact('frais'));

    }

    public function validFrais(Request $request)
    {
        $frais=new Frais();
        $frais->id_visiteur=session('id_visiteur');
        $frais->anneemois=$request->input('mois');
        $frais->nbjustificatifs=$request->input('nbjustif');
        $frais->montantvalide=$request->input('valide');
        $frais->id_etat=$request->input('etat');
        $frais->datemodification=date("Y-m-d");

        $service=new FraisService();
        $service->saveFrais($frais);

        return redirect(url('/listerFrais'));
    }

    public function editFrais($id)
    {
        $service=new FraisService();
        $frais=$service->getFrais($id);
        return view('formFrais',compact('frais'));

    }




}
