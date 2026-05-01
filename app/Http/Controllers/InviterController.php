<?php
namespace App\Http\Controllers;

use App\Service\InviterService;
use Illuminate\Http\Request;

class InviterController extends Controller
{
    protected $inviterService;

    public function __construct(InviterService $inviterService)
    {
        $this->inviterService = $inviterService;
    }

    public function index()
    {
        return response()->json($this->inviterService->getAllInvitations());
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_activite_compl' => 'required|integer',
            'id_praticien'      => 'required|integer',
            'specialiste'       => 'required|string|max:1' // 'O' ou 'N'
        ]);

        $this->inviterService->addInvitation($request->all());
        return response()->json(['message' => 'Invitation créée avec succès'], 201);
    }

    public function update(Request $request, $id_activite_compl, $id_praticien)
    {
        $request->validate([
            'specialiste' => 'required|string|max:1'
        ]);

        $this->inviterService->updateInvitation($id_activite_compl, $id_praticien, $request->specialiste);
        return response()->json(['message' => 'Invitation modifiée avec succès']);
    }

    public function destroy($id_activite_compl, $id_praticien)
    {
        $this->inviterService->deleteInvitation($id_activite_compl, $id_praticien);
        return response()->json(['message' => 'Invitation supprimée avec succès']);
    }
}
