@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold">
                {{ $service->nom }}
            </h1>

            <p class="text-muted mb-0">
                Gestion du service et de ses réservations
            </p>
        </div>

        <a href="{{ route('services.index') }}"
           class="btn btn-secondary">
            ← Retour aux services
        </a>

    </div>


    {{-- INFORMATIONS DU SERVICE --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h4 class="fw-bold mb-3">
                Informations du service
            </h4>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>Nom du service</strong>

                    <div class="text-muted">
                        {{ $service->nom }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <strong>Téléphone</strong>

                    <div class="text-muted">
                        {{ $service->telephone }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <strong>Adresse</strong>

                    <div class="text-muted">
                        {{ $service->adresse }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <strong>Horaires</strong>

                    <div class="text-muted">
                        {{ $service->heure_ouverture }}
                        -
                        {{ $service->heure_fermeture }}
                    </div>

                </div>


                <div class="col-12">

                    <strong>Description</strong>

                    <div class="text-muted">
                        {{ $service->description }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- MODULES DU SERVICE --}}
    <h3 class="fw-bold mb-3">
        Gestion du service
    </h3>

    <div class="row g-4">


        {{-- PRESTATIONS --}}
        <div class="col-md-6 col-lg-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body text-center">

                    <div class="fs-1 mb-3">
                        📋
                    </div>

                    <h5 class="fw-bold">
                        Prestations
                    </h5>

                    <p class="text-muted small">
                        Gérer les prestations proposées par ce service.
                    </p>

                    <a href="{{ route('prestations.index', ['idService' => $service->idService]) }}"
                        class="btn btn-vlife">
                         Gérer
                    </a>

                </div>

            </div>

        </div>


        {{-- RESSOURCES --}}
        <div class="col-md-6 col-lg-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body text-center">

                    <div class="fs-1 mb-3">
                        🛠️
                    </div>

                    <h5 class="fw-bold">
                        Ressources
                    </h5>

                    <p class="text-muted small">
                        Gérer les ressources utilisées par ce service.
                    </p>

                    <a href="{{ route('ressources.index', ['idService' => $service->idService]) }}"
                       class="btn btn-vlife">
                        Gérer
                    </a>

                </div>

            </div>

        </div>


        {{-- RÉSERVATIONS --}}
        <div class="col-md-6 col-lg-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body text-center">

                    <div class="fs-1 mb-3">
                        📅
                    </div>

                    <h5 class="fw-bold">
                        Réservations
                    </h5>

                    <p class="text-muted small">
                        Consulter et gérer les réservations.
                    </p>

                    <a href="{{ route('reservations.index', ['idService' => $service->idService]) }}"
                      class="btn btn-vlife">
                      Gérer
                    </a>

                </div>

            </div>

        </div>


        {{-- DISPONIBILITÉS --}}
        <div class="col-md-6 col-lg-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body text-center">

                    <div class="fs-1 mb-3">
                        🕐
                    </div>

                    <h5 class="fw-bold">
                        Disponibilités
                    </h5>

                    <p class="text-muted small">
                        Consulter les disponibilités du service.
                    </p>

                    <button class="btn btn-vlife">
                        Consulter
                    </button>

                </div>

            </div>

        </div>


    </div>

</div>

@endsection