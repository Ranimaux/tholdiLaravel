<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Model\UtilisateurQuery;

class AuthentificationController extends Controller {

    public function authentificationCompteUtilisateur(Request $request) {
        $identifiant = $request->post("identifiant");
        $password = $request->post("password");

        $compteExistant = UtilisateurQuery::create()
                ->findOneByIdentifiant($identifiant);
        if (Hash::check($password, $compteExistant->getPassword())) {
            $request->session()->put('connected');
            $request->session()->put('utilisateur', $compteExistant);
        }
        return back();
    }

}
