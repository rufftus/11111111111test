<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SpecialiteService;

class SpecialiteController extends Controller
{
    // Fonction préservée pour ne pas casser ton ancienne route
    public function practiceB()
    {
        // Ton code existant s'il y en avait un
        return view('home');
    }

    public function topSpecialites()
    {
        try {
            $service = new SpecialiteService();
            $specialites = $service->getListTop();
            return view('topSpecialites', compact('specialites'));
        } catch (\Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function topSpecialitesAPI()
    {
        try {
            $service = new SpecialiteService();
            $specialites = $service->getListTop();
            return response()->json($specialites, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
