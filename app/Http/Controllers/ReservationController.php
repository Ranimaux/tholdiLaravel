<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\VilleQuery;
use App\Http\Model\ReservationQuery;
use App\Http\Model\Reservation;
use App\Http\Model\Reserver;
use App\Http\Model\TypecontainerQuery;

class ReservationController extends Controller {

    public function saisirReservation() {
        $collectionVilles = VilleQuery::create()->find()->toArray();
        return view('reservation.saisirReservation', ['collectionVilles' => $collectionVilles]);
    }

    public function ajouterReservation(Request $request) {
        $dateDebutReservation = $request->input('dateDebutReservation');
        $dateFinReservation = $request->input('dateFinReservation');
        $codeVilleMiseDisposition = $request->input('codeVilleMiseDisposition');
        $codeVilleRendre = $request->input('codeVilleRendre');
        $volumeEstime = $request->input('volumeEstime');
        $compteUtilisateur = $request->session()->get('utilisateur');
        $code = $compteUtilisateur->getCodeutilisateur();
        $uneReservation = new Reservation();
        $uneReservation->setCodeutilisateur($code);
        $uneReservation->setDatedebutreservation($dateDebutReservation);
        $uneReservation->setDatefinreservation($dateFinReservation);
        $uneReservation->setCodevillemisedispo($codeVilleMiseDisposition);
        $uneReservation->setCodevillerendre($codeVilleRendre);
        $uneReservation->setVolumeestime($volumeEstime);
        $uneReservation->setDatereservation(date("Y-m-d H:i:s"));
        
        $request->session()->put("reservation", $uneReservation);

        $typeContainer = TypecontainerQuery::create()->find()->toArray();

        $view = view('reservation.saisirLigneDeReservation', ['typeContainer' => $typeContainer]
        );

        return $view;
    }

    public function ajouterLigneDeReservation(Request $request) {

        $container = $request->input('container');
        $quantite = $request->input('quantite');

        $reserver = new Reserver();
        $reserver->setNumtypecontainer($container);
        $reserver->setQtereserver($quantite);
        $reserver->setTypecontainer($reserver->getTypecontainer());

        if ($request->session()->has("collectionReserver") == false) {
            $collectionReserver = collect([$reserver]);
            $request->session()->put("collectionReserver", $collectionReserver);
        } else {
            $collectionReserver = $request->session()
                    ->get("collectionReserver");
            $result = $collectionReserver->contains(function ($item, $key) use ($reserver) {
                return $item->equals($reserver) == true;
            }
            );

            if ($result != true) {
                $collectionReserver->push($reserver);
            } else {
                $collectionReserver->map(function ($item, $key) use ($reserver) {
                    if ($item->equals($reserver) == true) {
                        $item->setQtereserver($reserver->getQtereserver());
                    }
                }
                );
            }
        }

        $typeContainer = TypecontainerQuery::create()->find()->toArray();
        $typeContainer = collect($typeContainer);
        $view = view('reservation.saisirLigneDeReservation',
                ['typeContainer' => $typeContainer],
                ['collectionReserver' => $collectionReserver]
        );
        return $view;
    }

    public function finaliserLaReservation(Request $request) {
        $reservation = $request->session()->get("reservation");
        $reservation->initReservers();
        $collectionReserver = $request->session()->get("collectionReserver");
        $collectionReserver->map(function (Reserver $item, int $key) use ($reservation) {
            $reservation->addReserver($item);
        });
        $reservation->save();
        $request->session()->forget("reservation");
        $request->session()->forget("collectionReserver");        
        return redirect()->action([ReservationController::class, 'consulterLesReservations']);
    }
    
    public function consulterLesReservations(){
        $collectionReservation = ReservationQuery::create()                 
                ->leftJoinWithVilleRelatedByCodevillemisedispo()                
                ->leftJoinWithReserver()
                ->useReserverQuery()
                ->leftJoinWithTypecontainer()
                ->endUse()
                ->find();
        
        foreach($collectionReservation as $reservation) {
            $reservation->setVilleRelatedByCodevillerendre($reservation->getVilleRelatedByCodevillerendre());
        }
        
        return view('reservation.consulterReservations', 
                ['collectionReservation' => $collectionReservation]);
    }
}
