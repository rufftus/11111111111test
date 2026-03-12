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
                    'specialite.lib_specialite',
                    DB::raw('COUNT(inviter.id_praticien) as total_invitations')
                )
                ->join('posseder', 'posseder.id_specialite', '=', 'specialite.id_specialite')
                ->join('inviter', 'inviter.id_praticien', '=', 'posseder.id_praticien')
                ->groupBy(
                    'specialite.id_specialite',
                    'specialite.lib_specialite'
                )
                ->orderBy('total_invitations', 'desc')
                ->limit(5)
                ->get();

            return $liste;

        } catch (QueryException $exception) {
            throw new UserException("Impossible d'accéder à la base de données.", $exception->getMessage(), $exception->getCode());
        }
    }

}

