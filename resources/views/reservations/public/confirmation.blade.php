@extends('layouts.public')

@section('content')

<div class="container py-5">

    <div class="text-center">

        <h1 class="fw-bold" style="color:#8B0038;">
            Réservation enregistrée !
        </h1>

        <p class="mt-3">
            Merci pour votre demande de réservation auprès de VLIFE.
        </p>

    </div>

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body p-5">

            <h4 style="color:#8B0038;">
                Détails de votre réservation
            </h4>

            <hr>

            <p>
                <strong>Numéro :</strong>
                #{{ $reservation->idReservation }}
            </p>

            <p>
                <strong>Client :</strong>
                {{ $reservation->client->prenom }}
                {{ $reservation->client->nom }}
            </p>

            <p>
                <strong>Service :</strong>
                {{ $reservation->service->nom }}
            </p>

            <p>
                <strong>Prestation :</strong>
                {{ $reservation->detailReservations->first()->prestation->nom }}
            </p>

            <p>
                <strong>Date :</strong>
                {{ $reservation->date_reservation }}
            </p>

            <p>
                <strong>Horaire :</strong>
                {{ $reservation->heure_debut }}
                -
                {{ $reservation->heure_fin }}
            </p>

            <p>
    <strong>Statut :</strong>

    @if($reservation->statut === 'En_attente')
        <span style="
            display:inline-block;
            background:#fff3cd;
            color:#856404;
            padding:6px 14px;
            border-radius:20px;
            font-weight:600;
        ">
            En attente de confirmation
        </span>
    @elseif($reservation->statut === 'Confirmee')
        <span style="
            display:inline-block;
            background:#d4edda;
            color:#155724;
            padding:6px 14px;
            border-radius:20px;
            font-weight:600;
        ">
            Confirmée
        </span>
    @elseif($reservation->statut === 'Annulee')
        <span style="
            display:inline-block;
            background:#f8d7da;
            color:#721c24;
            padding:6px 14px;
            border-radius:20px;
            font-weight:600;
        ">
            Annulée
        </span>
    @else
        <span style="
            display:inline-block;
            background:#e2e3e5;
            color:#383d41;
            padding:6px 14px;
            border-radius:20px;
            font-weight:600;
        ">
            {{ $reservation->statut }}
        </span>
    @endif
</p>

        <div class="mt-4 d-flex gap-3 flex-wrap">

    <a
        href="{{ url('/') }}"
        class="btn"
        style="
            background:linear-gradient(
                135deg,
                #8B0038,
                #333333
            );
            color:white;
            padding:12px 25px;
            border-radius:25px;
        "
    >
        Retour à l'accueil
    </a>

    <a
        href="{{ url('/reservation') }}"
        class="btn"
        style="
            background:#ffffff;
            color:#8B0038;
            border:2px solid #8B0038;
            padding:10px 23px;
            border-radius:25px;
            font-weight:600;
        "
    >
        Faire une autre réservation
            </a>

          </div>

        </div>

    </div>

</div>

@endsection