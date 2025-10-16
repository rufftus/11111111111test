<?php

namespace App\Service;

use App\Models\FraisHF;

class FraisHFService
{
    public function getListFraisHF($id)
    {
        $liste=FraisHF::query()
            ->select('fraishorsforfait.*','frais.id_frais')
            ->join('frais','fraishorsforfait.id_frais','=','frais.id_frais')
            ->where('frais.id_frais','=',$id)
            ->orderBy('date_fraishorsforfait')
            ->get();

        return $liste;
    }

    public function getTotalHF($id)
    {
        FraisHF::query()->where('id_frais','=',$id)->sum('montant_fraishorsforfait');
    }

}
