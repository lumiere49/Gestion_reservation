<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Prestation;
use App\Models\Paiement;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        // ==============================
        // STATISTIQUES GENERALES
        // ==============================

        $nombreClients = Client::count();

        $nombreReservations = Reservation::count();

        $nombrePrestations = Prestation::count();

        $nombrePaiements = Paiement::count();

        $nombreServices = Service::count();

        // ==============================
        // RESERVATIONS PAR CANAL
        // ==============================

       $reservationsParCanal = Reservation::select('canal_reservation')
       ->selectRaw('COUNT(*) as total')
       ->groupBy('canal_reservation')
       ->get();


        // ==============================
        // STATISTIQUES DES RESERVATIONS
        // ==============================

        $reservationsEnAttente = Reservation::where(
            'statut',
            'En_attente'
        )->count();

        $reservationsConfirmees = Reservation::where(
            'statut',
            'Confirmee'
        )->count();

        $reservationsAnnulees = Reservation::where(
            'statut',
            'Annulee'
        )->count();


        // ==============================
        // CHIFFRE D'AFFAIRES
        // ==============================

        $chiffreAffaires = Paiement::where(
            'statut',
            'payer'
        )->sum('montant');


        // ==============================
        // DERNIERES RESERVATIONS
        // ==============================

        $dernieresReservations = Reservation::with([
            'client',
            'service',
            'detailReservations.prestation',
            'ressources'
        ])
        ->orderByDesc('idReservation')
        ->take(5)
        ->get();


        // ==============================
        // DERNIERS PAIEMENTS
        // ==============================

        $derniersPaiements = Paiement::with([
            'reservation.client'
        ])
        ->orderByDesc('idPaiement')
        ->take(5)
        ->get();


        // ==============================
        // SERVICES VLIFE
        // ==============================

        $services = Service::all();


        return view('dashboard', compact(
            'nombreClients',
            'nombreReservations',
            'nombrePrestations',
            'nombrePaiements',
            'nombreServices',

            'reservationsEnAttente',
            'reservationsConfirmees',
            'reservationsAnnulees',

            'chiffreAffaires',

            'dernieresReservations',
            'derniersPaiements',

            'services',
            'reservationsParCanal',
        ));
    }
}