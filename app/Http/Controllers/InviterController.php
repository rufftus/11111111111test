<?php

namespace App\Http\Controllers;

use App\Models\Activite_compl;
use Illuminate\Http\Request;
use App\Models\Inviter;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Service\InviterService;

class InviterController extends Controller
{
    public function addInviter()
    {
        $service = new InviterService();
        $activites = $service->getActivites();
        $praticiens = $service->getPraticiens();

        $invitation = (object)['id_activite_compl' => '', 'id_praticien' => ''];

        return view('formInvitation', compact('invitation', 'activites', 'praticiens'));
    }

    public function validInviter(Request $request)
    {
        try {
            $service = new InviterService();
            $id_activite = $request->input('id_activite_compl');
            $id_praticien = $request->input('id_praticien');

            $old_id_activite = $request->input('old_id_activite_compl');
            $old_id_praticien = $request->input('old_id_praticien');

            $service->saveInvitation($id_activite, $id_praticien, $old_id_activite, $old_id_praticien);

            return redirect('/');

        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function editInviter($id_activite, $id_praticien)
    {
        $service = new InviterService();
        $invitation = $service->getInvitation($id_activite, $id_praticien);
        $activites = $service->getActivites();
        $praticiens = $service->getPraticiens();

        return view('formInvitation', compact('invitation', 'activites', 'praticiens'));
    }

    public function removeInviter($id_activite, $id_praticien)
    {
        $service = new InviterService();
        $service->deleteInvitation($id_activite, $id_praticien);
        return redirect('/'); // À adapter selon ton projet
    }
}
