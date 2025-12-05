<?php

namespace App\Http\Controllers;

use App\Models\Visiteur;
use Illuminate\Http\Request;
use App\Service\VisiteurService;
use Illuminate\Support\Facades\Auth;

class VisiteurController extends Controller
{
    public function login()
    {
        try {
            return view('login');
        }
        catch (\Exception $exception)
        {
            return view('error',compact('exception'));
        }
    }

    public function logout()
    {
        try{
        $visiteur = new VisiteurService();
        $visiteur->signOut();
        return redirect(url('/'));
    }
    catch (\Exception $exception)
        {
            return view('error',compact('exception'));
        }
    }

    public function auth(Request $request)
    {
        try {
            $login = $request->input('login');
            $mdp = $request->input('mdp'); // correspond au champ name="mdp"

            $service = new VisiteurService();

            if ($service->signIn($login, $mdp)) {
                return redirect(url('/'));
            } else {
                $erreur = "Identifiant ou mot de passe incorrect";
                return view('login', compact('erreur'));
            }
        }

    catch (\Exception $exception)
        {
            return view('error',compact('exception'));
        }
    }


    public function initPasswordAPI(Request $request){
        try{
            $request->validate(['pwd_visiteur'=>'required|min:3']);
            $hash=bcrypt($request->json('pwd_visiteur'));
            Visiteur::query()->update(['pwd_visiteur'=>$hash]);
            return response()->json(['status'=>'mots de passe reinitialis']);
        }
        catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],500);
        }
    }

    public function authApi(Request $request){
        try{
            $request->validate([
                'login'=>'required',
                'mdp'=>'required'
            ]);
            $login = $request->json('login');
            $pwd = $request->json('pwd');
            $identifiants = ['login_visiteur'=>$login,'password'=>$pwd];
            if(!Auth::attempt($identifiants)){
                return response()->json(['error'=>'Identifiant incorrect'],401);
            }

            $visiteur=$request->user();
            $token=$visiteur->createToken('authToken')->plainTextToken;
        }
        catch (\Exception $exception){}
    }
}
