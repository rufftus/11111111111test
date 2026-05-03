<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Praticien;
use App\Models\TypePraticien;
use App\Models\Specialite;
use Illuminate\Support\Facades\DB;

class PraticienController extends Controller
{
    // Fonctionnalité 1 : Recherche
    public function recherche(Request $request)
    {
        $query = Praticien::with('typePraticien');

        if ($request->filled('nom')) {
            $query->where('nom_praticien', 'like', '%' . $request->nom . '%');
        }
        if ($request->filled('id_type_praticien')) {
            $query->where('id_type_praticien', $request->id_type_praticien);
        }

        $praticiens = $query->get();
        $types = TypePraticien::all();

        return view('praticiens.recherche', compact('praticiens', 'types'));
    }

    // Fonctionnalité 3 : Praticiens par spécialité
    public function parSpecialite(Request $request)
    {
        $specialites = Specialite::all();
        $praticiens = collect();

        if ($request->filled('id_specialite')) {
            $specialite = Specialite::with('praticiens')->find($request->id_specialite);
            if($specialite) {
                // Via la relation belongsToMany (table posseder)
                $praticiens = Praticien::whereHas('specialites', function($q) use($request) {
                    $q->where('specialite.id_specialite', $request->id_specialite);
                })->get();
            }
        }

        return view('praticiens.par_specialite', compact('specialites', 'praticiens'));
    }

    // Fonctionnalité 4 : Top 5 des spécialités (le plus de praticiens invités)
    public function topSpecialites()
    {
        $topSpecialites = DB::table('specialite')
            ->join('posseder', 'specialite.id_specialite', '=', 'posseder.id_specialite')
            ->join('inviter', 'posseder.id_praticien', '=', 'inviter.id_praticien')
            ->select('specialite.lib_specialite', DB::raw('COUNT(DISTINCT inviter.id_praticien) as nb_invites'))
            ->groupBy('specialite.id_specialite', 'specialite.lib_specialite')
            ->orderByDesc('nb_invites')
            ->limit(5)
            ->get();

        return view('praticiens.top_specialites', compact('topSpecialites'));
    }







    // Pour la recherche dans React
    public function apiRecherche(Request $request) {
        $query = Praticien::with('typePraticien');
        if ($request->nom) $query->where('nom_praticien', 'like', '%' . $request->nom . '%');
        if ($request->id_type_praticien) $query->where('id_type_praticien', $request->id_type_praticien);
        return response()->json($query->get());
    }

// Pour le Top 5 dans React
    public function apiTopSpecialites() {
        $data = DB::table('specialite')
            ->join('posseder', 'specialite.id_specialite', '=', 'posseder.id_specialite')
            ->join('inviter', 'posseder.id_praticien', '=', 'inviter.id_praticien')
            ->select('specialite.lib_specialite', DB::raw('COUNT(DISTINCT inviter.id_praticien) as nb_invites'))
            ->groupBy('specialite.id_specialite', 'specialite.lib_specialite')
            ->orderByDesc('nb_invites')->limit(5)->get();
        return response()->json($data);
    }

// Pour le filtre par spécialité
    public function apiBySpecialite($id) {
        $praticiens = Praticien::whereHas('specialites', function($q) use($id) {
            $q->where('specialite.id_specialite', $id);
        })->get();
        return response()->json($praticiens);
    }
}
