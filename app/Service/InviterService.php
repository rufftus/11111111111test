<?php
namespace App\Service;
use Illuminate\Support\Facades\DB;

class InviterService
{
    public function getAllInvitations()
    {
        return DB::table('inviter')
            ->join('praticien', 'inviter.id_praticien', '=', 'praticien.id_praticien')
            ->join('activite_compl', 'inviter.id_activite_compl', '=', 'activite_compl.id_activite_compl')
            ->select('inviter.*', 'praticien.nom_praticien', 'praticien.prenom_praticien', 'activite_compl.theme_activite', 'activite_compl.date_activite')
            ->get();
    }

    public function addInvitation($data)
    {
        return DB::table('inviter')->insert([
            'id_activite_compl' => $data['id_activite_compl'],
            'id_praticien'      => $data['id_praticien'],
            'specialiste'       => $data['specialiste']
        ]);
    }

    public function updateInvitation($id_activite_compl, $id_praticien, $specialiste)
    {
        return DB::table('inviter')
            ->where('id_activite_compl', $id_activite_compl)
            ->where('id_praticien', $id_praticien)
            ->update(['specialiste' => $specialiste]);
    }

    public function deleteInvitation($id_activite_compl, $id_praticien)
    {
        return DB::table('inviter')
            ->where('id_activite_compl', $id_activite_compl)
            ->where('id_praticien', $id_praticien)
            ->delete();
    }
}
