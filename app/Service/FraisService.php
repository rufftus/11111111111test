<?php

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Frais;
use App\Models\Etat;
use Illuminate\Database\QueryException;

class FraisService
{
    public function getListFrais($id_visiteur)
    {
        try {
            $liste=Frais::query()
                ->select('frais.*','etat.lib_etat')
                ->join('etat','etat.id_etat','=','frais.id_etat')
                ->where('id_visiteur','=',$id_visiteur)
                ->get();

            return $liste;

        }
        catch (QueryException $exception)
        {
            $userMessage="Impossible dacceder a la base de donnees.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function saveFrais(Frais $frais)
    {
        try {
            $frais->save();
        }
        catch (QueryException $exception)
        {
            $userMessage="Impossible dacceder a la base de donnees.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function getFrais($id)
    {
        try {
            $frais = Frais::query()->find($id);
            return $frais;
        }
        catch (QueryException $exception)
        {
            $userMessage="Impossible dacceder a la base de donnees.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());        }
    }

    public function getListEtats()
    {
        try {
            $etat = Etat::query()->get();
            return $etat;
        }
        catch (QueryException $exception)
        {
            $userMessage="Impossible dacceder a la base de donnees.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function deleteFrais($id)
    {
        try {
            $frais = Frais::query()->find($id);
            $frais->delete();
        }
        catch (QueryException $exception)
        {
            if($exception->getCode()==23000)
            {
                $userMessage="Impossible de supprimer une fiche avec des frais saisis ";
            }
            else
            {
                $userMessage="Erreur de suppression dans la base de donnees.";
            }


           throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

}
