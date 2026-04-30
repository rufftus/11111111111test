<?php

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Praticien;
use Illuminate\Database\QueryException;

class PraticienService
{

    public function getListPracticien()
    {
        $praticiens = Praticien::leftJoin('posseder', 'praticien.id_praticien', '=', 'posseder.id_praticien')
            ->leftJoin('specialite', 'posseder.id_specialite', '=', 'specialite.id_specialite')
            ->select('praticien.*', 'specialite.lib_specialite')
            ->orderBy('specialite.lib_specialite', 'asc')
            ->get();

        return $praticiens;
    }



}
