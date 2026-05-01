<?php
namespace App\Http\Controllers;

use App\Models\Praticien;
use Illuminate\Http\Request;

class PraticienController extends Controller
{
    // Fonctionnalité 1 : Recherche d'un praticien sur son nom ou le type de praticien
    public function search(Request $request)
    {
        $query = $request->input('q');

        $praticiens = Praticien::with('typePraticien')
            ->where('nom_praticien', 'LIKE', "%{$query}%")
            ->orWhereHas('typePraticien', function($q) use ($query) {
                $q->where('lib_type_praticien', 'LIKE', "%{$query}%");
            })
            ->get();

        return response()->json($praticiens);
    }

    // Fonctionnalité 3 : Affichage des praticiens par spécialité
    public function getBySpecialite($id_specialite)
    {
        $praticiens = Praticien::with('typePraticien')
            ->whereHas('specialites', function($q) use ($id_specialite) {
                $q->where('specialite.id_specialite', $id_specialite);
            })->get();

        return response()->json($praticiens);
    }
}
