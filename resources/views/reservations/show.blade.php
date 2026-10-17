@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Détails de la réservation</h1>

            <p class="text-muted mb-0">
                Consultation de la réservation
                <strong>#{{ $reservation->idReservation }}</strong>.
            </p>
        </div>

        <div class="reservation-show-actions">

            <a href="{{ route('reservations.index') }}"
               class="btn btn-reservation-back">
                ← Retour aux réservations
            </a>

            <a href="{{ route('reservations.edit', $reservation->idReservation) }}"
               class="btn btn-reservation-edit">
                Modifier
            </a>

        </div>

    </div>


    <!-- CARTE PRINCIPALE -->

    <div class="row g-4">


        <!-- COLONNE PRINCIPALE -->

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm reservation-show-card">

                <!-- HEADER -->

                <div class="reservation-show-header">

                    <div class="reservation-show-icon">
                        VL
                    </div>

                    <div>

                        <span class="reservation-show-label">
                            RÉSERVATION VLIFE
                        </span>

                        <h2 class="mb-1">
                            Réservation #{{ $reservation->idReservation }}
                        </h2>

                        <p class="mb-0">
                            {{ $reservation->date_reservation }}
                            •
                            {{ $reservation->heure_debut }}
                            - {{ $reservation->heure_fin }}
                        </p>

                    </div>

                </div>


                <div class="card-body p-4 p-lg-5">


                    <!-- INFORMATIONS GÉNÉRALES -->

                    <div class="reservation-detail-section">

                        <div class="reservation-detail-section-title">
                            <span class="reservation-detail-section-number">
                                1
                            </span>

                            <div>
                                <h5>Informations générales</h5>
                                <p>Informations principales de la réservation.</p>
                            </div>
                        </div>


                        <div class="row g-4">

                            <div class="col-md-4">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        ID réservation
                                    </span>

                                    <strong class="reservation-detail-value">
                                        #{{ $reservation->idReservation }}
                                    </strong>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        Date
                                    </span>

                                    <strong class="reservation-detail-value">
                                        {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                                    </strong>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        Horaire
                                    </span>

                                    <strong class="reservation-detail-value">
                                        {{ $reservation->heure_debut }}
                                        -
                                        {{ $reservation->heure_fin }}
                                    </strong>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        Statut
                                    </span>

                                    @php
                                        $statut = strtolower($reservation->statut);
                                    @endphp

                                    @if($statut === 'confirmee' || $statut === 'confirmée')

                                        <span class="reservation-status status-confirmed">
                                            Confirmée
                                        </span>

                                    @elseif($statut === 'en_attente')

                                        <span class="reservation-status status-pending">
                                            En attente
                                        </span>

                                    @elseif($statut === 'annulee' || $statut === 'annulée')

                                        <span class="reservation-status status-cancelled">
                                            Annulée
                                        </span>

                                    @else

                                        <span class="reservation-status status-default">
                                            {{ $reservation->statut }}
                                        </span>

                                    @endif

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        Canal de réservation
                                    </span>

                                    <strong class="reservation-detail-value">
                                        {{ $reservation->canal_reservation }}
                                    </strong>

                                </div>

                            </div>


                            <div class="col-12">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        Ressource affectée
                                    </span>

                                    <div class="reservation-show-resources">

                                        @forelse($reservation->ressources as $ressource)

                                            <span class="reservation-resource">
                                                {{ $ressource->nom }}
                                            </span>

                                        @empty

                                            <span class="reservation-not-assigned">
                                                Aucune ressource affectée
                                            </span>

                                        @endforelse

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="reservation-show-divider">


                    <!-- CLIENT -->

                    <div class="reservation-detail-section">

                        <div class="reservation-detail-section-title">

                            <span class="reservation-detail-section-number">
                                2
                            </span>

                            <div>

                                <h5>Client</h5>

                                <p>
                                    Informations du client ayant effectué la réservation.
                                </p>

                            </div>

                        </div>


                        <div class="reservation-client-show">

                            <div class="reservation-client-show-avatar">

                                {{ strtoupper(substr($reservation->client->prenom ?? 'C', 0, 1)) }}

                            </div>

                            <div>

                                <strong>
                                    {{ $reservation->client->nom ?? 'Client' }}
                                    {{ $reservation->client->prenom ?? '' }}
                                </strong>

                                <span>
                                    Client VLIFE
                                </span>

                            </div>

                        </div>

                    </div>


                    <hr class="reservation-show-divider">


                    <!-- SERVICE -->

                    <div class="reservation-detail-section">

                        <div class="reservation-detail-section-title">

                            <span class="reservation-detail-section-number">
                                3
                            </span>

                            <div>

                                <h5>Service</h5>

                                <p>
                                    Service VLIFE concerné par la réservation.
                                </p>

                            </div>

                        </div>


                        <div class="row g-4">

                            <div class="col-md-4">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        Service
                                    </span>

                                    <strong class="reservation-detail-value">
                                        {{ $reservation->service->nom }}
                                    </strong>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        Adresse
                                    </span>

                                    <strong class="reservation-detail-value">
                                        {{ $reservation->service->adresse }}
                                    </strong>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="reservation-detail-item">

                                    <span class="reservation-detail-label">
                                        Téléphone
                                    </span>

                                    <strong class="reservation-detail-value">
                                        {{ $reservation->service->telephone }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="reservation-show-divider">


                    <!-- PRESTATIONS -->

                    <div class="reservation-detail-section">

                        <div class="reservation-detail-section-title">

                            <span class="reservation-detail-section-number">
                                4
                            </span>

                            <div>

                                <h5>Prestation(s)</h5>

                                <p>
                                    Prestations associées à cette réservation.
                                </p>

                            </div>

                        </div>


                        <div class="table-responsive">

                            <table class="table reservation-detail-table align-middle mb-0">

                                <thead>

                                    <tr>
                                        <th>Prestation</th>
                                        <th>Quantité</th>
                                        <th>Prix</th>
                                    </tr>

                                </thead>

                                <tbody>

                                @forelse($reservation->detailReservations as $detail)

                                    <tr>

                                        <td>

                                            <strong>
                                                {{ $detail->prestation->nom }}
                                            </strong>

                                        </td>

                                        <td>

                                            <span class="reservation-quantity">
                                                {{ $detail->quantite }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="reservation-price">
                                                {{ number_format($detail->prix, 0, ',', ' ') }}
                                                FCFA
                                            </span>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="3"
                                            class="text-center py-4 text-muted">

                                            Aucune prestation associée.

                                        </td>

                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>


                    <!-- ACTIONS -->

                    <div class="reservation-show-footer">

                        <a href="{{ route('reservations.index') }}"
                           class="btn btn-reservation-cancel">
                            Retour à la liste
                        </a>

                        <a href="{{ route('reservations.edit', $reservation->idReservation) }}"
                           class="btn btn-reservation-edit">
                            Modifier la réservation
                        </a>

                    </div>

                </div>

            </div>

        </div>


        <!-- COLONNE ACTION -->

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm reservation-payment-card">

                <div class="reservation-payment-header">

                    <div class="reservation-payment-icon">
                        ₣
                    </div>

                    <div>

                        <h5 class="mb-1">
                            Paiement
                        </h5>

                        <span>
                            Gestion du paiement de la réservation
                        </span>

                    </div>

                </div>


                <div class="card-body p-4">

                    @if($reservation->statut === 'En_attente')

                        <div class="reservation-payment-info">

                            <strong>
                                Réservation en attente
                            </strong>

                            <p>
                                Cette réservation n'est pas encore confirmée.
                                Vous pouvez procéder au paiement pour la confirmer.
                            </p>

                        </div>


                        <form
                            action="{{ route('paiements.payer', $reservation->idReservation) }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-reservation-payment">

                                💳 Payer cette réservation

                            </button>

                        </form>

                    @elseif($reservation->statut === 'Confirmee')

                        <div class="reservation-payment-success">

                            <div class="reservation-payment-success-icon">
                                ✓
                            </div>

                            <strong>
                                Réservation confirmée
                            </strong>

                            <p>
                                Cette réservation a été confirmée.
                            </p>

                        </div>

                    @elseif($reservation->statut === 'Annulee')

                        <div class="reservation-payment-cancelled">

                            <strong>
                                Réservation annulée
                            </strong>

                            <p>
                                Le paiement n'est pas disponible pour cette réservation.
                            </p>

                        </div>

                    @else

                        <div class="reservation-payment-info">

                            <strong>
                                Statut : {{ $reservation->statut }}
                            </strong>

                            <p>
                                Le paiement est indisponible pour ce statut.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection