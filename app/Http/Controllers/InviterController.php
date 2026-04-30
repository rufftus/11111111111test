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
    public function listInviter() {
        try {
            $service = new InviterService();
            $invitations = $service->getAllInvitations();
            return view('listInvitations', compact('invitations'));
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function addInviter()
    {
        $service = new InviterService();
        $activites = $service->getActivites();
        $praticiens = $service->getPraticiens();
        return view('formInvitation', compact('activites', 'praticiens'));
    }

    public function editInviter($id_activite, $id_praticien)
    {
        $service = new InviterService();
        $invitation = $service->getInvitation($id_activite, $id_praticien);
        $activites = $service->getActivites();
        $praticiens = $service->getPraticiens();
        return view('formInvitation', compact('invitation', 'activites', 'praticiens'));
    }

    public function validInviter(Request $request)
    {
        try {
            $service = new InviterService();
            $id_activite = $request->input('id_activite_compl');
            $id_praticien = $request->input('id_praticien');
            $specialiste = $request->input('specialiste') ?? 'Non défini';

            $old_id_activite = $request->input('old_id_activite_compl');
            $old_id_praticien = $request->input('old_id_praticien');

            $service->saveInvitation($id_activite, $id_praticien, $specialiste, $old_id_activite, $old_id_praticien);

            return redirect('/listerInvitations');
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function removeInviter($id_activite, $id_praticien)
    {
        try {
            $service = new InviterService();
            $service->deleteInvitation($id_activite, $id_praticien);
            return redirect('/listerInvitations');
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    // --- METHODES API POUR REACT ---
    public function listInviterAPI() {
        try {
            $service = new InviterService();
            return response()->json($service->getAllInvitations(), 200);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function addInviterAPI(Request $request) {
        try {
            $service = new InviterService();
            $service->saveInvitation($request->id_activite_compl, $request->id_praticien, $request->specialiste ?? 'Non défini');
            return response()->json(['success' => true, 'message' => 'Invitation ajoutée'], 201);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function updateInviterAPI(Request $request) {
        try {
            $service = new InviterService();
            $service->saveInvitation($request->id_activite_compl, $request->id_praticien, $request->specialiste ?? 'Non défini', $request->old_id_activite_compl, $request->old_id_praticien);
            return response()->json(['success' => true, 'message' => 'Invitation modifiée'], 200);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function removeInviterAPI($id_activite, $id_praticien) {
        try {
            $service = new InviterService();
            $service->deleteInvitation($id_activite, $id_praticien);
            return response()->json(['success' => true, 'message' => 'Invitation supprimée'], 200);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
