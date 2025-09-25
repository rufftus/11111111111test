<?php

namespace App\Http\Controllers;

use App\Service\FraisService;

class FraisController
{
    public function listerFrais()
    {
        $services = new FraisService();
        $id_visiteur= session('id_visiteur');
        $fiches=$services->getListFrais($id_visiteur);
        return view('listerFrais',['fiches'=>$fiches]);
    }
}
