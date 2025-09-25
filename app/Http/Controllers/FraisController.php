<?php

namespace App\Http\Controllers;

use App\Service\FraisService;
use App\Service\VisiteurService;


class FraisController extends Controller
{
    public function listerFrais()
    {
        $services = new FraisService();
        $id_visiteur= session('id_visiteur');
        $fiches=$services->getListFrais($id_visiteur);
        return view('listerFrais',['fiches'=>$fiches]);
    }

    public function listFrais()
    {
        $frais=[];
        return view('listerFrais',['frais'=>$frais]);
    }


}
