<?php

namespace App\Service;

use App\Models\Frais;

class FraisService
{
    public function getListFrais($id_visiteur)
    {
        $liste=Frais::querry()->where('id_visiteur','=',$id_visiteur)->get();
        return $liste;
    }
}
