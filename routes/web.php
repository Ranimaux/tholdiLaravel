<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthentificationController;
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

//use App\Http\Model\PaysQuery ;
//
//$collectionDePays = PaysQuery::create()->find();
//dd($collectionDePays);

Route::post('/authentification', [AuthentificationController::class, 'authentificationCompteUtilisateur'])
        ->name('r-authentification');

Route::get('/deconnexion', [AuthentificationController::class, 'deconnexion'])
        ->name('r-deconnexion');

Route::get('/', function() {
    return view('accueil.accueil');
});

Route::get('/', function () {
    return view('welcome');
});
