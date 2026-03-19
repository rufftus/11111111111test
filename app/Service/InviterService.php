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

    public function saveInvitation($id_activite, $id_praticien, $old_id_activite = null, $old_id_praticien = null) {
        // Si c'est une modification, on supprime l'ancienne liaison d'abord
        if ($old_id_activite && $old_id_praticien) {
            $this->deleteInvitation($old_id_activite, $old_id_praticien);
        }

       Inviter::insert([
            'id_activite_compl' => $id_activite,
            'id_praticien'      => $id_praticien
        ]);
    }

    public function deleteInvitation($id_activite, $id_praticien) {
        Inviter::where('id_activite_compl', $id_activite)
            ->where('id_praticien', $id_praticien)
            ->delete();
    }
}
