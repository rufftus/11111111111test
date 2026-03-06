<?php

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Praticien;
use Illuminate\Database\QueryException;

class PraticienService
{

    public function getListPracticien($id_praticien)
    {
        try {
            $liste=Praticien::query()
                ->select('praticien.*','specialite.lib_specialite')
                ->join('posseder','posseder.id_praticien','=','praticien.id_praticien')
                ->join('specialite','specialite.id_specialite','=','posseder.id_specialite')
                ->where('id_praticien','=',$id_praticien)
                ->get();

            return $liste;

        }
        catch (QueryException $exception)
        {
            $userMessage="Impossible dacceder a la base de donnees.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

}
