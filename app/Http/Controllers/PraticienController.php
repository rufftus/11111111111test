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
            $id_praticien= session('id_praticien');
            $fiches=$services->getListPracticien($id_praticien);
            return view('listPraticiens',compact('fiches'));
        }
        catch (\Exception $exception)
        {
            return view('error',compact('exception'));
        }

    }
}
