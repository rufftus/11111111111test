<?php
namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Support\Facades\DB;

class SpecialiteController extends Controller
{
    // Liste toutes les spécialités (utile pour ton menu déroulant en React)
    public function index()
    {
        return response()->json(Specialite::all());
    }

    // Fonctionnalité 4 : Top 5 spécialités (le plus de praticiens invités)
    public function top5()
    {
        $topSpecialites = DB::table('specialite')
            ->join('posseder', 'specialite.id_specialite', '=', 'posseder.id_specialite')
            ->join('inviter', 'posseder.id_praticien', '=', 'inviter.id_praticien')
            ->select('specialite.id_specialite', 'specialite.lib_specialite', DB::raw('count(DISTINCT inviter.id_praticien) as total_invites'))
            ->groupBy('specialite.id_specialite', 'specialite.lib_specialite')
            ->orderByDesc('total_invites')
            ->limit(5)
            ->get();

        return response()->json($topSpecialites);
    }
}
