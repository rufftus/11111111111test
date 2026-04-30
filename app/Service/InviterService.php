<?php

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Inviter;
use App\Models\Activite_compl;
use App\Models\Praticien;
use Illuminate\Database\QueryException;

class InviterService
{
    public function getActivites() {
        return Activite_compl::all();
    }

    public function getPraticiens() {
        return Praticien::all();
    }

    public function getInvitation($id_activite, $id_praticien) {
        return Inviter::where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->first();
    }

    public function deleteInvitation($id_activite, $id_praticien) {
        Inviter::where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->delete();
    }

    public function getAllInvitations() {
        return Inviter::join('praticien', 'inviter.id_praticien', '=', 'praticien.id_praticien')
            ->join('activite_compl', 'inviter.id_activite_compl', '=', 'activite_compl.id_activite_compl')
            ->select('inviter.*', 'praticien.nom_praticien', 'praticien.prenom_praticien', 'activite_compl.theme_activite', 'activite_compl.lieu_activite')
            ->get();
    }

    public function saveInvitation($id_activite, $id_praticien, $specialiste, $old_id_activite = null, $old_id_praticien = null) {
        if ($old_id_activite && $old_id_praticien) {
            Inviter::where('id_activite_compl', $old_id_activite)
                ->where('id_praticien', $old_id_praticien)
                ->update([
                    'id_activite_compl' => $id_activite,
                    'id_praticien' => $id_praticien,
                    'specialiste' => $specialiste
                ]);
        } else {
            Inviter::insert([
                'id_activite_compl' => $id_activite,
                'id_praticien' => $id_praticien,
                'specialiste' => $specialiste
            ]);
        }
    }
}
