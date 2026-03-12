<?php

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Praticien;
use App\Models\Specialite;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SpecialiteService
{

    public function getListTop()
    {
        try {
            $liste = Specialite::query()
                ->select('specialite.lib_specialite', DB::raw('COUNT(inviter.id_praticien) as total_invitations'))
                ->join('posseder', 'posseder.id_specialite', '=', 'specialite.id_specialite')
                ->join('praticien', 'praticien.id_praticien', '=', 'posseder.id_praticien')
                ->join('inviter', 'inviter.id_praticien', '=', 'praticien.id_praticien')
                ->join('activite_compl', 'activite_compl.id_activite_compl', '=', 'inviter.id_activite_compl')
                ->groupBy('specialite.lib_specialite')
                ->get();

            return $liste;

        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de données.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

}

