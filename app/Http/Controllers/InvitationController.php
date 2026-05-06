<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Praticien;
use App\Models\ActiviteCompl;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
    // Liste des invitations pour un praticien donné
    public function index($id_praticien)
    {
        $praticien = Praticien::with('activites')->findOrFail($id_praticien);
        return view('invitations.indexx', compact('praticien'));
    }

    // Formulaire d'ajout
    public function create($id_praticien)
    {
        $praticien = Praticien::findOrFail($id_praticien);
        // On récupère les activités auxquelles il n'est pas encore invité
        $activites = ActiviteCompl::whereNotIn('id_activite_compl', function($query) use ($id_praticien) {
            $query->select('id_activite_compl')->from('inviter')->where('id_praticien', $id_praticien);
        })->get();

        return view('invitations.create', compact('praticien', 'activites'));
    }

    // Sauvegarde de l'ajout
    public function store(Request $request)
    {
        try {
            DB::table('inviter')->insert([
                'id_activite_compl' => $request->id_activite_compl,
                'id_praticien'      => $request->id_praticien,
                'specialiste'       => $request->specialiste
            ]);

            // Si la requête vient de React (API), on renvoie du JSON
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Invitation ajoutée avec succès'], 201);
            }

            return redirect()->route('invitations.indexx', $request->id_praticien)->with('success', 'Invitation ajoutée.');
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['error' => 'Ce praticien est déjà invité à cette activité'], 400);
            }
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
        }
    }

    // Formulaire de modification
    public function edit($id_activite, $id_praticien)
    {
        $praticien = Praticien::findOrFail($id_praticien);
        $activite = ActiviteCompl::findOrFail($id_activite);
        $invitation = DB::table('inviter')
            ->where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->first();

        return view('invitations.edit', compact('praticien', 'activite', 'invitation'));
    }

    // Sauvegarde de la modification
// Sauvegarde de la modification
    public function update(Request $request, $id_activite, $id_praticien)
    {
        DB::table('inviter')
            ->where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->update(['specialiste' => $request->specialiste]);

        // Si la requête vient de React
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['message' => 'Invitation modifiée avec succès']);
        }

        return redirect()->route('invitations.index', $id_praticien)->with('success', 'Invitation modifiée.');
    }


    // Suppression
    public function destroy($id_activite, $id_praticien)
    {
        DB::table('inviter')
            ->where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->delete();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json(['message' => 'Invitation supprimée']);
        }

        return redirect()->back()->with('success', 'Invitation supprimée.');
    }










    public function apiIndex($id_praticien) {
        $praticien = Praticien::with('activites')->findOrFail($id_praticien);
        return response()->json($praticien);
    }

    public function getActivites() {
        return response()->json(\App\Models\ActiviteCompl::all());
    }
}
