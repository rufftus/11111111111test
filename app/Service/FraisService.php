<?php

namespace App\Service;

use App\Models\Frais;

class FraisService
{
    public function getListFrais($id_visiteur)
    {
        try {
            $liste = Frais::query()->where('id_visiteur', '=', $id_visiteur)->get();
            return $liste;
        }
        catch (\Exception $exception)
        {
            return view('errors',compact('exception'));
        }
    }

    public function saveFrais(Frais $frais)
    {
        try {
            $frais->save();
        }
        catch (\Exception $exception)
        {
            return view('errors',compact('exception'));
        }
    }

    public function getFrais($id)
    {
        try {
            $frais = Frais::query()->find($id);
            return $frais;
        }
        catch (\Exception $exception)
        {
            return view('errors',compact('exception'));
        }
    }
}
