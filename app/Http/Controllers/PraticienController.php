<?php

namespace App\Http\Controllers;

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

    public function practiceC()
    {

    }


}
