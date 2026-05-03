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
        DB::table('inviter')->insert([
            'id_activite_compl' => $request->id_activite_compl,
            'id_praticien' => $request->id_praticien,
            'specialiste' => $request->specialiste // 'O' ou 'N'
        ]);

        return redirect()->route('invitations.index', $request->id_praticien)->with('success', 'Invitation ajoutée.');
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
    public function update(Request $request, $id_activite, $id_praticien)
    {
        DB::table('inviter')
            ->where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->update(['specialiste' => $request->specialiste]);

        return redirect()->route('invitations.index', $id_praticien)->with('success', 'Invitation modifiée.');
    }

    // Suppression
    public function destroy($id_activite, $id_praticien)
    {
        DB::table('inviter')
            ->where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->delete();

        return redirect()->back()->with('success', 'Invitation supprimée.');
    }
}
