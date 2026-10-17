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
            Vous êtes connecté en tant qu'Employé.
        </p>
    </div>

    <div class="row g-4">

        <!-- Nouvelle réservation -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        Nouvelle réservation
                    </h5>

                    <p class="card-text text-muted">
                        Enregistrer une nouvelle réservation pour l'un des services de VLIFE.
                    </p>

                    <a href="{{ route('reservations.create') }}"
                       class="btn btn-primary">
                        Créer une réservation
                    </a>
                </div>
            </div>
        </div>

        <!-- Réservations -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        Réservations
                    </h5>

                    <p class="card-text text-muted">
                        Consulter les réservations enregistrées.
                    </p>

                    <a href="{{ route('reservations.index') }}"
                       class="btn btn-primary">
                        Voir les réservations
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

        <!-- Services -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        Services
                    </h5>

                    <p class="card-text text-muted">
                        Consulter les différents services de VLIFE.
                    </p>

                    <a href="{{ route('services.index') }}"
                       class="btn btn-primary">
                        Voir les services
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
                        Consulter les prestations disponibles.
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
                        Consulter les ressources disponibles.
                    </p>

                    <a href="{{ route('ressources.index') }}"
                       class="btn btn-primary">
                        Voir les ressources
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection