<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\FraisService;
use App\Models\Praticien;
use App\Models\Specialite;
use App\Service\SpecialiteService;

class SpecialiteController extends Controller
{
    public function practiceB()
    {
        try {
            $services = new SpecialiteService();
            $fiches=$services->getListTop();
            return view('toppracticien',compact('fiches'));
        }
        catch (\Exception $exception)
        {
            return view('error',compact('exception'));
        }

    }
}
