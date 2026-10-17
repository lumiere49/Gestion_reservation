@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- ========================================= --}}
    {{-- EN-TETE --}}
    {{-- ========================================= --}}

    <div class="mb-4">
        <h1 class="fw-bold">Tableau de bord</h1>

        <p class="text-muted">
            Bienvenue sur le portail unifié de réservation VLIFE.
        </p>
    </div>

    

    {{-- ========================================= --}}
    {{-- STATISTIQUES GENERALES --}}
    {{-- ========================================= --}}

    <div class="row g-4 mb-4">

        {{-- CLIENTS --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Clients
                    </h6>

                    <h2 class="fw-bold">
                        {{ $nombreClients }}
                    </h2>

                    <a href="/clients" class="text-decoration-none">
                       Voir les clients →
                    </a>

                </div>

            </div>

        </div>


        {{-- RESERVATIONS --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Réservations
                    </h6>

                    <h2 class="fw-bold">
                        {{ $nombreReservations }}
                    </h2>

                   <a href="/reservations" class="text-decoration-none">
                       Voir les réservations →
                </a>

                </div>

            </div>

        </div>


        {{-- PRESTATIONS --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Prestations
                    </h6>

                    <h2 class="fw-bold">
                        {{ $nombrePrestations }}
                    </h2>

                    

                        <a href="/prestations" class="text-decoration-none">
                           Voir les prestations →
                        </a>

                </div>

            </div>

        </div>


        {{-- PAIEMENTS --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Paiements
                    </h6>

                    <h2 class="fw-bold">
                        {{ $nombrePaiements }}
                    </h2>

                    
                </div>

            </div>

        </div>
        <a href="/paiements" class="btn btn-outline-primary">
              Voir tout
        </a>

    </div>


    {{-- ========================================= --}}
    {{-- ETAT DES RESERVATIONS --}}
    {{-- ========================================= --}}

    <div class="row g-4 mb-4">

        {{-- EN ATTENTE --}}
        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted">
                                Réservations en attente
                            </h6>

                            <h2 class="fw-bold">
                                {{ $reservationsEnAttente }}
                            </h2>

                        </div>

                        <div style="font-size:35px;">
                            ⏳
                        </div>

                    </div>

                </div>

            </div>

        </div>

 {{-- ========================================= --}}
{{-- RESERVATIONS PAR CANAL --}}
{{-- ========================================= --}}

<div class="row g-4 mb-4">

    <div class="col-12">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    Réservations par canal
                </h5>

                <div class="row g-3">

                    {{-- SITE WEB --}}
                    <div class="col-md-6 col-lg">

                        <div class="border rounded p-3 text-center h-100">

                            <div style="font-size: 30px;">
                                🌐
                            </div>

                            <h6 class="mt-2">
                                Site web
                            </h6>

                            <h3 class="fw-bold">
                                {{ $reservationsParCanal->where('canal_reservation', 'Site_web')->first()->total ?? 0 }}
                            </h3>

                            <small class="text-muted">
                                réservation(s)
                            </small>

                        </div>

                    </div>


                    {{-- TELEPHONE --}}
                    <div class="col-md-6 col-lg">

                        <div class="border rounded p-3 text-center h-100">

                            <div style="font-size: 30px;">
                                ☎️
                            </div>

                            <h6 class="mt-2">
                                Téléphone
                            </h6>

                            <h3 class="fw-bold">
                                {{ $reservationsParCanal->where('canal_reservation', 'Telephone')->first()->total ?? 0 }}
                            </h3>

                            <small class="text-muted">
                                réservation(s)
                            </small>

                        </div>

                    </div>


                    {{-- PHYSIQUE --}}
                    <div class="col-md-6 col-lg">

                        <div class="border rounded p-3 text-center h-100">

                            <div style="font-size: 30px;">
                                🏢
                            </div>

                            <h6 class="mt-2">
                                Physique
                            </h6>

                            <h3 class="fw-bold">
                                {{ $reservationsParCanal->where('canal_reservation', 'Physique')->first()->total ?? 0 }}
                            </h3>

                            <small class="text-muted">
                                réservation(s)
                            </small>

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="col-md-6 col-lg">

                        <div class="border rounded p-3 text-center h-100">

                            <div style="font-size: 30px;">
                                ✉️
                            </div>

                            <h6 class="mt-2">
                                Email
                            </h6>

                            <h3 class="fw-bold">
                                {{ $reservationsParCanal->where('canal_reservation', 'Email')->first()->total ?? 0 }}
                            </h3>

                            <small class="text-muted">
                                réservation(s)
                            </small>

                        </div>

                    </div>


                    {{-- APPLICATION MOBILE --}}
                    <div class="col-md-6 col-lg">

                        <div class="border rounded p-3 text-center h-100">

                            <div style="font-size: 30px;">
                                📱
                            </div>

                            <h6 class="mt-2">
                                Application mobile
                            </h6>

                            <h3 class="fw-bold">
                                {{ $reservationsParCanal->where('canal_reservation', 'Application_mobile')->first()->total ?? 0 }}
                            </h3>

                            <small class="text-muted">
                                réservation(s)
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

        {{-- CONFIRMEES --}}
        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted">
                                Réservations confirmées
                            </h6>

                            <h2 class="fw-bold">
                                {{ $reservationsConfirmees }}
                            </h2>

                        </div>

                        <div style="font-size:35px;">
                            ✅
                        </div>

                    </div>

                </div>

            </div>
            
        </div>


        {{-- ANNULEES --}}
        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted">
                                Réservations annulées
                            </h6>

                            <h2 class="fw-bold">
                                {{ $reservationsAnnulees }}
                            </h2>

                        </div>

                        <div style="font-size:35px;">
                            ❌
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- CHIFFRE D'AFFAIRES --}}
    {{-- ========================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h6 class="text-muted">
                        Chiffre d'affaires encaissé
                    </h6>

                    <h2 class="fw-bold mb-0">

                        {{ number_format($chiffreAffaires, 0, ',', ' ') }}

                        FCFA

                    </h2>

                    <small class="text-muted">
                        Total des paiements confirmés
                    </small>

                </div>

                <div style="font-size:40px;">
                    💰
                </div>

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- DERNIERES RESERVATIONS --}}
    {{-- ========================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>

                    <h4 class="fw-bold mb-1">
                        Dernières réservations
                    </h4>

                    <p class="text-muted mb-0">
                        Les cinq dernières réservations enregistrées.
                    </p>

                </div>

                <a href="{{ route('reservations.index') }}"
                   class="btn btn-outline-primary">

                    Voir tout

                </a>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Client</th>

                            <th>Service</th>

                            <th>Prestation</th>

                            <th>Date</th>

                            <th>Statut</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($dernieresReservations as $reservation)

                        <tr>

                            <td>
                                #{{ $reservation->idReservation }}
                            </td>

                            <td>

                                {{ $reservation->client->nom ?? 'N/A' }}

                            </td>

                            <td>

                                {{ $reservation->service->nom ?? 'N/A' }}

                            </td>

                            <td>

                                @foreach($reservation->detailReservations as $detail)

                                    {{ $detail->prestation->nom ?? 'N/A' }}

                                @endforeach

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}

                            </td>

                            <td>

                                @if($reservation->statut === 'En_attente')

                                    <span class="badge bg-warning text-dark">
                                        En attente
                                    </span>

                                @elseif($reservation->statut === 'Confirmee')

                                    <span class="badge bg-success">
                                        Confirmée
                                    </span>

                                @elseif($reservation->statut === 'Annulee')

                                    <span class="badge bg-danger">
                                        Annulée
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ $reservation->statut }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center text-muted">

                                Aucune réservation enregistrée.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- DERNIERS PAIEMENTS --}}
    {{-- ========================================= --}}

    <div class="card shadow-sm border-0 mb-5">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>

                    <h4 class="fw-bold mb-1">
                        Derniers paiements
                    </h4>

                    <p class="text-muted mb-0">
                        Les cinq derniers paiements enregistrés.
                    </p>

                </div>

                <a href="{{ route('paiements.index') }}"
                   class="btn btn-outline-primary">

                    Voir tout

                </a>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Réservation</th>

                            <th>Client</th>

                            <th>Montant</th>

                            <th>Mode</th>

                            <th>Statut</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($derniersPaiements as $paiement)

                        <tr>

                            <td>
                                #{{ $paiement->idPaiement }}
                            </td>

                            <td>
                                #{{ $paiement->idReservation }}
                            </td>

                            <td>

                                {{ $paiement->reservation->client->nom ?? 'N/A' }}

                            </td>

                            <td>

                                {{ number_format($paiement->montant, 0, ',', ' ') }}
                                FCFA

                            </td>

                            <td>

                                {{ $paiement->mode_paiement }}

                            </td>

                            <td>

                                @if($paiement->statut === 'payer')

                                    <span class="badge bg-success">
                                        Payé
                                    </span>

                                @elseif($paiement->statut === 'En_attente')

                                    <span class="badge bg-warning text-dark">
                                        En attente
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Échoué
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center text-muted">

                                Aucun paiement enregistré.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- SERVICES VLIFE --}}
    {{-- ========================================= --}}

    <div class="mb-3">

        <h3 class="fw-bold">
            Les services VLIFE
        </h3>

        <p class="text-muted">
            Sélectionnez un service pour accéder à sa gestion.
        </p>

    </div>


    @php

        $images = [

            2 => 'images/Vcuts.png',

            3 => 'images/VitechImg.png',

            4 => 'images/VTCImg.png',

            5 => 'images/VloundeImg.png',

            6 => 'images/Bureau2Coworking.jpeg',

        ];

    @endphp


    <div class="row g-4">

        @foreach ($services as $service)

            <div class="col-md-6 col-lg-3">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body text-center">

                        <img
                            src="{{ asset($images[$service->idService] ?? 'images/default-service.png') }}"
                            alt="{{ $service->nom }}"
                            style="height:80px; max-width:160px; object-fit:contain;"
                        >

                        <h5 class="mt-3 fw-bold">

                            {{ $service->nom }}

                        </h5>

                        <p class="text-muted small">

                            {{ $service->description }}

                        </p>

                        <a href="{{ route('services.show', $service->idService) }}"
                           class="btn btn-vlife mt-2">

                            Gérer

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

{{-- ========================================= --}}
{{-- GRAPHIQUE DES RESERVATIONS PAR CANAL --}}
{{-- ========================================= --}}

<div class="row g-4 mb-4">

```
<div class="col-12">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5 class="fw-bold mb-0">
                    Répartition des réservations par canal
                </h5>

                <button
                    type="button"
                    class="btn btn-sm btn-outline-dark"
                    onclick="telechargerGraphiqueCanal()">
                    📥 Télécharger le graphique
                </button>

            </div>

            <div style="height: 350px;">
                <canvas id="reservationsCanalChart"></canvas>
            </div>

        </div>

    </div>

</div>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const reservationsCanal = @json($reservationsParCanal);

    const labels = [
        'Site web',
        'Téléphone',
        'Physique',
        'Email',
        'Application mobile'
    ];

    const donnees = [
        reservationsCanal.find(c => c.canal_reservation === 'Site_web')?.total ?? 0,
        reservationsCanal.find(c => c.canal_reservation === 'Telephone')?.total ?? 0,
        reservationsCanal.find(c => c.canal_reservation === 'Physique')?.total ?? 0,
        reservationsCanal.find(c => c.canal_reservation === 'Email')?.total ?? 0,
        reservationsCanal.find(c => c.canal_reservation === 'Application_mobile')?.total ?? 0
    ];

    const ctx = document
        .getElementById('reservationsCanalChart')
        .getContext('2d');

    const reservationsCanalChart = new Chart(ctx, {

        type: 'bar',

        data: {
            labels: labels,

            datasets: [{
                label: 'Nombre de réservations',
                data: donnees,

                backgroundColor: [
                    '#8B0038',
                    '#333333',
                    '#666666',
                    '#999999',
                    '#C2185B'
                ],

                borderWidth: 0
            }]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            scales: {

                y: {
                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    }
                }

            },

            plugins: {

                legend: {
                    display: true
                }

            }

        }

    });


    // =========================================
    // TELECHARGEMENT DU GRAPHIQUE EN PNG
    // =========================================

    function telechargerGraphiqueCanal() {

        const lien = document.createElement('a');

        lien.href = reservationsCanalChart
            .toBase64Image('image/png', 1);

        lien.download = 'reservations_par_canal.png';

        lien.click();
    }

</script>

@endsection