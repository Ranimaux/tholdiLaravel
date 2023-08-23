<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\ReservationController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('accueil.accueil');
});

Route::post('/authentification', [AuthentificationController::class, 'authentificationCompteUtilisateur'])
        ->name('r-authentification');

Route::get('/deconnexion', [AuthentificationController::class, 'deconnexion'])
        ->name('r-deconnexion');

Route::group(['prefix' => 'reservation'], function () {
    Route::get('saisirReservation', [ReservationController::class, 'saisirReservation'])
            ->name('r-saisirReservation');
    Route::post('ajouterReservation', [ReservationController::class, 'ajouterReservation'])
            ->name('r-ajouterReservation');
    Route::post('ajouterLigneReservation', [ReservationController::class, 'ajouterLigneDeReservation'])
            ->name('r-ajouterLigneReservation');
    Route::post('finaliserLaReservation', [ReservationController::class, 'finaliserLaReservation'])
            ->name('r-finaliserLaReservation');   
    Route::get('consulterLesReservations', [ReservationController::class, 'consulterLesReservations'])
            ->name('r-consulterLesReservations'); 
});

