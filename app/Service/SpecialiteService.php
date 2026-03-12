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
                ->select(
                    'specialite.id_specialite',
                    'specialite.lib_specialite',
                    'activite_compl.theme_activite',
                    'activite_compl.motif_activite',
                    DB::raw('COUNT(inviter.id_praticien) as total_invitations')
                )
                ->join('posseder', 'posseder.id_specialite', '=', 'specialite.id_specialite')
                ->join('praticien', 'praticien.id_praticien', '=', 'posseder.id_praticien')
                ->join('inviter', 'inviter.id_praticien', '=', 'praticien.id_praticien')
                ->join('activite_compl', 'activite_compl.id_activite_compl', '=', 'inviter.id_activite_compl')
                ->groupBy(
                    'specialite.id_specialite',
                    'specialite.lib_specialite',
                    'activite_compl.theme_activite',
                    'activite_compl.motif_activite'
                )
                ->orderBy('total_invitations', 'desc')
                ->limit(5)
                ->get();

            return $liste;

        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de données.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

}

