@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">
            Tableau de bord
        </h2>

        <p class="text-muted mb-0">
            Bienvenue {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
        </p>

        <p class="text-muted">
            Responsable du service :
            <strong>{{ $utilisateur->service->nom ?? 'Service non défini' }}</strong>
        </p>
    </div>

    <div class="row g-4">

        <!-- Réservations -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        Réservations
                    </h5>

                    <p class="card-text text-muted">
                        Consulter et gérer les réservations de votre service.
                    </p>

                    <a href="{{ route('reservations.index') }}"
                       class="btn btn-primary">
                        Voir les réservations
                    </a>
                </div>
            </div>
        </div>

        <!-- Prestations -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        Prestations
                    </h5>

                    <p class="card-text text-muted">
                        Consulter les prestations de votre service.
                    </p>

                    <a href="{{ route('prestations.index') }}"
                       class="btn btn-primary">
                        Voir les prestations
                    </a>
                </div>
            </div>
        </div>

        <!-- Ressources -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        Ressources
                    </h5>

                    <p class="card-text text-muted">
                        Consulter les ressources de votre service.
                    </p>

                    <a href="{{ route('ressources.index') }}"
                       class="btn btn-primary">
                        Voir les ressources
                    </a>
                </div>
            </div>
        </div>

        <!-- Clients -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        Clients
                    </h5>

                    <p class="card-text text-muted">
                        Consulter les informations des clients.
                    </p>

                    <a href="{{ route('clients.index') }}"
                       class="btn btn-primary">
                        Voir les clients
                    </a>
                </div>
            </div>
        </div>

        <!-- Paiements -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        Paiements
                    </h5>

                    <p class="card-text text-muted">
                        Consulter et gérer les paiements de votre service.
                    </p>

                    <a href="{{ route('paiements.index') }}"
                       class="btn btn-primary">
                        Voir les paiements
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection