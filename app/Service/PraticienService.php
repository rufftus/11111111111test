<?php

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Praticien;
use Illuminate\Database\QueryException;

class PraticienService
{

    public function getListPracticien()
    {
        try {
            $liste = Praticien::query()
                ->select('praticien.*', 'specialite.lib_specialite')
                ->join('posseder', 'posseder.id_praticien', '=', 'praticien.id_praticien')
                ->join('specialite', 'specialite.id_specialite', '=', 'posseder.id_specialite')
                ->orderBy('specialite.lib_specialite', 'asc')
                ->get();

            return $liste;

        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de données.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }



}
