@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Réservations VLIFE</h1>

            <p class="text-muted mb-0">
                Gestion et suivi des réservations du portail unifié.
            </p>
        </div>

        <a href="{{ route('reservations.create') }}"
           class="btn btn-vlife">
            + Nouvelle réservation
        </a>

    </div>


    <!-- MESSAGES -->

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm"
             role="alert">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show shadow-sm"
             role="alert">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger shadow-sm">

            <strong>
                Une erreur est survenue :
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- CARTE RÉSERVATIONS -->

    <div class="card border-0 shadow-sm reservation-table-card">

        <!-- EN-TÊTE CARTE -->

        <div class="card-header reservation-table-header">

            <div>

                <h5 class="mb-1 fw-bold">
                    Liste des réservations
                </h5>

                <span>
                    Réservations enregistrées dans les différents services VLIFE
                </span>

            </div>

        </div>


        <!-- TABLEAU -->

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Client</th>

                            <th>Service</th>

                            <th>Prestation</th>

                            <th>Ressource</th>

                            <th>Prix</th>

                            <th>Date</th>

                            <th>Horaire</th>

                            <th>Statut</th>

                            <th>Canal_reservation</th>

                            <th class="text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($reservations as $reservation)

                        <tr>

                            <!-- ID -->

                            <td>

                                <span class="reservation-id">
                                    #{{ $reservation->idReservation }}
                                </span>

                            </td>


                            <!-- CLIENT -->

                            <td>

                                <div class="reservation-client">

                                    <div class="reservation-client-icon">
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

                            </td>


                            <!-- SERVICE -->

                            <td>

                                <div class="reservation-service">

                                    <div class="reservation-service-icon">
                                        VL
                                    </div>

                                    <strong>
                                        {{ $reservation->service->nom ?? 'Service non renseigné' }}
                                    </strong>

                                </div>

                            </td>


                            <!-- PRESTATIONS -->

                            <td>

                                <div class="reservation-prestations">

                                    @forelse($reservation->detailReservations as $detail)

                                        <span class="reservation-prestation">
                                            {{ $detail->prestation->nom ?? 'Prestation' }}
                                        </span>

                                    @empty

                                        <span class="reservation-empty-value">
                                            Aucune prestation
                                        </span>

                                    @endforelse

                                </div>

                            </td>


                            <!-- RESSOURCES -->

                            <td>

                                <div class="reservation-resources">

                                    @forelse($reservation->ressources as $ressource)

                                        <span class="reservation-resource">
                                            {{ $ressource->nom }}
                                        </span>

                                    @empty

                                        <span class="reservation-not-assigned">
                                            Non affectée
                                        </span>

                                    @endforelse

                                </div>

                            </td>


                            <!-- PRIX -->

                            <td>

                                <div class="reservation-prices">

                                    @forelse($reservation->detailReservations as $detail)

                                        <span class="reservation-price">

                                            {{ number_format($detail->prix, 0, ',', ' ') }}
                                            FCFA

                                        </span>

                                    @empty

                                        <span class="reservation-empty-value">
                                            -
                                        </span>

                                    @endforelse

                                </div>

                            </td>


                            <!-- DATE -->

                            <td>

                                <span class="reservation-date">

                                    {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}

                                </span>

                            </td>


                            <!-- HORAIRE -->

                            <td>

                                <span class="reservation-time">

                                    {{ $reservation->heure_debut }}
                                    -
                                    {{ $reservation->heure_fin }}

                                </span>

                            </td>


                            <!-- STATUT -->

                            <td>

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

                            </td>

                            <td>
                          {{ $reservation->canal_reservation }}
                           </td>


                            <!-- ACTIONS -->

                            <td>

                                <div class="reservation-actions">

    {{-- VOIR : accessible à tous --}}
    <a href="{{ route('reservations.show', $reservation->idReservation) }}"
       class="btn btn-reservation-view btn-sm">
        Détails
    </a>

    {{-- MODIFIER : interdit aux employés --}}
    @if(auth()->user()->role !== 'Employe')

        <a href="{{ route('reservations.edit', $reservation->idReservation) }}"
           class="btn btn-reservation-edit btn-sm">
            Modifier
        </a>

        {{-- ANNULER : interdit aux employés --}}
        <form action="{{ route('reservations.destroy', $reservation->idReservation) }}"
              method="POST"
              class="m-0"
              onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?');">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-reservation-delete btn-sm">
                Annuler
            </button>

        </form>

    @endif

</div>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="10">

                                <div class="reservation-empty">

                                    <div class="reservation-empty-icon">
                                        VL
                                    </div>

                                    <h5>
                                        Aucune réservation
                                    </h5>

                                    <p>
                                        Aucune réservation n'est actuellement enregistrée.
                                    </p>

                                    <a href="{{ route('reservations.create') }}"
                                       class="btn btn-vlife">
                                        + Créer une réservation
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection