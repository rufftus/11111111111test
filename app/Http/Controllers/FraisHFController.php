<?php

namespace App\Http\Controllers;

use App\Service\FraisHFService;
use App\Service\FraisService;


class FraisHFController extends Controller
{
    public function listFraisHF($id)
    {

            $service = new FraisService();
            $serviceHF = new FraisHFService();

            $frais = $service->getFrais($id);
            $listeHF = $serviceHF->getListFraisHF($id);
            $totalHF = $serviceHF->getTotalHF($id);
            return view('listFraisHF', compact('frais', 'listeHF', 'totalHF'));



    }

}
