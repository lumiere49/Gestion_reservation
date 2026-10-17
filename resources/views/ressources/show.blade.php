@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Détails de la ressource
            </h1>

            <p class="text-muted mb-0">
                Consultez les informations détaillées de cette ressource.
            </p>
        </div>

        <div class="ressource-show-actions">

            <a href="{{ route('ressources.index') }}"
               class="btn btn-ressource-back">
                ← Retour aux ressources
            </a>

            <a href="{{ route('ressources.edit', $ressource->idRessource) }}"
               class="btn btn-ressource-edit">
                Modifier
            </a>

        </div>

    </div>


    {{-- CARTE PRINCIPALE --}}
    <div class="row justify-content-center">

        <div class="col-lg-9 col-xl-8">

            <div class="card border-0 shadow-sm ressource-show-card">

                {{-- EN-TÊTE --}}
                <div class="ressource-show-header">

                    <div class="ressource-show-icon">
                        VL
                    </div>

                    <div>

                        <span class="ressource-show-label">
                            RESSOURCE VLIFE
                        </span>

                        <h2 class="mb-1">
                            {{ $ressource->nom }}
                        </h2>

                        <p class="mb-0">
                            Référence #{{ $ressource->idRessource }}
                        </p>

                    </div>

                </div>


                {{-- INFORMATIONS --}}
                <div class="card-body p-4 p-lg-5">

                    <div class="row g-4">

                        {{-- ID --}}
                        <div class="col-md-6">

                            <div class="ressource-detail-item">

                                <span class="ressource-detail-label">
                                    ID ressource
                                </span>

                                <strong class="ressource-detail-value ressource-detail-id">
                                    #{{ $ressource->idRessource }}
                                </strong>

                            </div>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-6">

                            <div class="ressource-detail-item">

                                <span class="ressource-detail-label">
                                    Nom de la ressource
                                </span>

                                <strong class="ressource-detail-value">
                                    {{ $ressource->nom }}
                                </strong>

                            </div>

                        </div>


                        {{-- TYPE --}}
                        <div class="col-md-6">

                            <div class="ressource-detail-item">

                                <span class="ressource-detail-label">
                                    Type
                                </span>

                                <strong class="ressource-detail-value">
                                    {{ $ressource->type }}
                                </strong>

                            </div>

                        </div>


                        {{-- ÉTAT --}}
                        <div class="col-md-6">

                            <div class="ressource-detail-item">

                                <span class="ressource-detail-label">
                                    État
                                </span>

                                <strong class="ressource-detail-value ressource-detail-status">
                                    {{ $ressource->etat }}
                                </strong>

                            </div>

                        </div>


                        {{-- CAPACITÉ --}}
                        <div class="col-md-6">

                            <div class="ressource-detail-item">

                                <span class="ressource-detail-label">
                                    Capacité
                                </span>

                                <strong class="ressource-detail-value">
                                    {{ $ressource->capacite ?? 'Non renseignée' }}
                                </strong>

                            </div>

                        </div>


                        {{-- SERVICE --}}
                        <div class="col-md-6">

                            <div class="ressource-detail-item">

                                <span class="ressource-detail-label">
                                    Service VLIFE
                                </span>

                                <strong class="ressource-detail-value">
                                    {{ $ressource->service->nom ?? 'Service non renseigné' }}
                                </strong>

                            </div>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-12">

                            <div class="ressource-detail-item ressource-detail-description">

                                <span class="ressource-detail-label">
                                    Description
                                </span>

                                <p class="mb-0">
                                    {{ $ressource->description ?? 'Aucune description renseignée.' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- ACTIONS BAS --}}
                    <div class="ressource-show-footer">

                        <a href="{{ route('ressources.index') }}"
                           class="btn btn-ressource-cancel">
                            Retour à la liste
                        </a>

                        <a href="{{ route('ressources.edit', $ressource->idRessource) }}"
                           class="btn btn-vlife btn-save-ressource">
                            Modifier la ressource
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection