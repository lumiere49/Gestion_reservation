@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- ============================= -->
    <!-- EN-TÊTE -->
    <!-- ============================= -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Services VLIFE
            </h1>

            <p class="text-muted mb-0">
                Gestion des différents services de l'entreprise.
            </p>
        </div>

        <a href="{{ route('services.create') }}"
           class="btn btn-vlife">

            + Ajouter un service

        </a>

    </div>


    <!-- ============================= -->
    <!-- MESSAGE DE SUCCÈS -->
    <!-- ============================= -->

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ============================= -->
    <!-- LISTE DES SERVICES -->
    <!-- ============================= -->

    <div class="row g-4">

        @forelse($services as $service)

            <div class="col-md-6 col-xl-4 d-flex">

                <div class="card shadow-sm border-0 w-100 service-card">

                    <!-- EN-TÊTE DE LA CARTE -->

                    <div class="service-card-header">

                        <div class="service-icon">
                            VL
                        </div>

                        <div>
                            <h4 class="fw-bold mb-1">
                                {{ $service->nom }}
                            </h4>

                            <span class="service-label">
                                Service VLIFE
                            </span>
                        </div>

                    </div>


                    <!-- CONTENU -->

                    <div class="card-body d-flex flex-column">

                        <p class="text-muted service-description">

                            {{ $service->description }}

                        </p>


                        <hr>


                        <!-- INFORMATIONS -->

                        <div class="service-information">

                            <div class="service-information-item">

                                <span class="service-information-label">
                                    Téléphone
                                </span>

                                <strong>
                                    {{ $service->telephone }}
                                </strong>

                            </div>


                            <div class="service-information-item">

                                <span class="service-information-label">
                                    Adresse
                                </span>

                                <strong>
                                    {{ $service->adresse }}
                                </strong>

                            </div>


                            <div class="service-information-item">

                                <span class="service-information-label">
                                    Horaires
                                </span>

                                <strong>
                                    {{ $service->heure_ouverture }}
                                    -
                                    {{ $service->heure_fermeture }}
                                </strong>

                            </div>

                        </div>


                        <!-- ============================= -->
                        <!-- BOUTONS -->
                        <!-- ============================= -->

                        <div class="d-flex gap-2 mt-auto pt-4 services-actions">

    <a href="{{ route('services.show', $service->idService) }}"
       class="btn btn-service-view btn-sm">
        Voir
    </a>

    <a href="{{ route('services.edit', $service->idService) }}"
       class="btn btn-service-edit btn-sm">
        Modifier
    </a>

    <form action="{{ route('services.destroy', $service->idService) }}"
          method="POST"
          class="m-0"
          onsubmit="return confirm('Voulez-vous vraiment supprimer ce service ?');">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-service-delete btn-sm">
            Supprimer
        </button>

    </form>

</div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info">

                    Aucun service n'est enregistré.

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection