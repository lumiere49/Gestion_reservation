<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DetailReservationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\EspaceController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

// Accueil
Route::get('/', function () {
    return view('welcome');
});

// Page publique de réservation
Route::get(
    '/reservation',
    [ReservationController::class, 'publicCreate']
)->name('reservation.public');

// Enregistrement d'une réservation publique
Route::post(
    '/reservation',
    [ReservationController::class, 'publicStore']
)->name('reservation.public.store');

// Confirmation de réservation
Route::get(
    '/reservation/confirmation/{idReservation}',
    [ReservationController::class, 'publicConfirmation']
)->name('reservation.confirmation');


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [LoginController::class, 'showLogin']
)->name('login');

Route::post(
    '/login',
    [LoginController::class, 'login']
)->name('login.submit');

Route::post(
    '/logout',
    [LoginController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTES ADMINISTRATEUR
|--------------------------------------------------------------------------
|
| Toutes les routes ci-dessous nécessitent une authentification.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

   Route::middleware('role:Administrateur')->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

});

    /*
|--------------------------------------------------------------------------
| ESPACES RESPONSABLE ET EMPLOYE
|--------------------------------------------------------------------------
*/

Route::middleware('role:Responsable')->group(function () {

    Route::get(
        '/responsable',
        [EspaceController::class, 'responsable']
    )->name('responsable.dashboard');

});

Route::middleware('role:Employe')->group(function () {

    Route::get(
        '/employe',
        [EspaceController::class, 'employe']
    )->name('employe.dashboard');

});

/*
|--------------------------------------------------------------------------
| UTILISATEURS
|--------------------------------------------------------------------------
|
| Gestion des comptes réservée à l'administrateur général.
|
*/

Route::middleware('role:Administrateur')->group(function () {

    Route::resource(
        'utilisateurs',
        UtilisateurController::class
    );

});

    /*
    |--------------------------------------------------------------------------
    | CLIENTS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'clients',
        ClientController::class
    );


    /*
    |--------------------------------------------------------------------------
    | SERVICES
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'services',
        ServiceController::class
    );


    /*
    |--------------------------------------------------------------------------
    | PRESTATIONS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'prestations',
        PrestationController::class
    );

    Route::get(
    '/services/{idService}/prestations',
    [ReservationController::class, 'byService']
    )->name('services.prestations');
    /*
    |--------------------------------------------------------------------------
    | RESSOURCES
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'ressources',
        RessourceController::class
    );

    // Route utilisée par l'administration
    // pour récupérer les ressources d'un service

    Route::get(
        '/services/{idService}/ressources',
        [ReservationController::class, 'ressourcesParService']
    )->name('services.ressources');


    /*
    |--------------------------------------------------------------------------
    | RESERVATIONS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'reservations',
        ReservationController::class
    );


    /*
    |--------------------------------------------------------------------------
    | DETAILS DES RESERVATIONS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'detail-reservations',
        DetailReservationController::class
    );


    /*
    |--------------------------------------------------------------------------
    | PAIEMENTS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'paiements',
        PaiementController::class
    );

    Route::post(
        '/paiements/{id}/payer',
        [PaiementController::class, 'payer']
    )->name('paiements.payer');

    Route::get(
        '/paiements/{id}/confirmation',
        [PaiementController::class, 'confirmation']
    )->name('paiements.confirmation');

    Route::post(
        '/paiements/{id}/confirmer',
        [PaiementController::class, 'confirmerPaiement']
    )->name('paiements.confirmer');

});