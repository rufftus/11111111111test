<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InviterController extends Controller
{
    // Récupérer toutes les invitations avec les infos liées
    public function index()
    {
        $invitations = DB::table('inviter')
            ->join('praticien', 'inviter.id_praticien', '=', 'praticien.id_praticien')
            ->join('activite_compl', 'inviter.id_activite_compl', '=', 'activite_compl.id_activite_compl')
            ->select('inviter.*', 'praticien.nom_praticien', 'praticien.prenom_praticien', 'activite_compl.theme_activite')
            ->get();

        return response()->json($invitations);
    }

    // AJOUT
    public function store(Request $request)
    {
        $request->validate([
            'id_activite_compl' => 'required|integer',
            'id_praticien'      => 'required|integer',
            'specialiste'       => 'required|string|max:1' // ex: 'O' ou 'N'
        ]);

        DB::table('inviter')->insert([
            'id_activite_compl' => $request->id_activite_compl,
            'id_praticien'      => $request->id_praticien,
            'specialiste'       => $request->specialiste
        ]);

        return response()->json(['message' => 'Invitation créée avec succès'], 201);
    }

    // MODIFICATION
    public function update(Request $request, $id_activite, $id_praticien)
    {
        $request->validate([
            'specialiste' => 'required|string|max:1'
        ]);

        DB::table('inviter')
            ->where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->update([
                'specialiste' => $request->specialiste
            ]);

        return response()->json(['message' => 'Invitation modifiée avec succès']);
    }

    // SUPPRESSION
    public function destroy($id_activite, $id_praticien)
    {
        DB::table('inviter')
            ->where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->delete();

        return response()->json(['message' => 'Invitation supprimée avec succès']);
    }
}
