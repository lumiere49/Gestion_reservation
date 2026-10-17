@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Détails de la prestation
            </h1>

            <p class="text-muted mb-0">
                Consultez les informations détaillées de cette prestation.
            </p>
        </div>

        <div class="prestation-show-actions">

            <a href="{{ route('prestations.index') }}"
               class="btn btn-prestation-back">
                ← Retour aux prestations
            </a>

            <a href="{{ route('prestations.edit', $prestation->idPrestation) }}"
               class="btn btn-prestation-edit">
                Modifier
            </a>

        </div>

    </div>


    {{-- CARTE PRINCIPALE --}}
    <div class="row justify-content-center">

        <div class="col-lg-9 col-xl-8">

            <div class="card border-0 shadow-sm prestation-show-card">

                {{-- EN-TÊTE DE LA CARTE --}}
                <div class="prestation-show-header">

                    <div class="prestation-show-icon">
                        VL
                    </div>

                    <div>
                        <span class="prestation-show-label">
                            PRESTATION VLIFE
                        </span>

                        <h2 class="mb-1">
                            {{ $prestation->nom }}
                        </h2>

                        <p class="mb-0">
                            Référence #{{ $prestation->idPrestation }}
                        </p>
                    </div>

                </div>


                {{-- INFORMATIONS --}}
                <div class="card-body p-4 p-lg-5">

                    <div class="row g-4">

                        {{-- ID --}}
                        <div class="col-md-6">

                            <div class="prestation-detail-item">

                                <span class="prestation-detail-label">
                                    ID prestation
                                </span>

                                <strong class="prestation-detail-value prestation-detail-id">
                                    #{{ $prestation->idPrestation }}
                                </strong>

                            </div>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-6">

                            <div class="prestation-detail-item">

                                <span class="prestation-detail-label">
                                    Nom de la prestation
                                </span>

                                <strong class="prestation-detail-value">
                                    {{ $prestation->nom }}
                                </strong>

                            </div>

                        </div>


                        {{-- PRIX --}}
                        <div class="col-md-6">

                            <div class="prestation-detail-item">

                                <span class="prestation-detail-label">
                                    Prix
                                </span>

                                <strong class="prestation-detail-value prestation-detail-price">
                                    {{ number_format($prestation->prix, 0, ',', ' ') }} FCFA
                                </strong>

                            </div>

                        </div>


                        {{-- DURÉE --}}
                        <div class="col-md-6">

                            <div class="prestation-detail-item">

                                <span class="prestation-detail-label">
                                    Durée
                                </span>

                                <strong class="prestation-detail-value">
                                    {{ $prestation->duree }} minutes
                                </strong>

                            </div>

                        </div>


                        {{-- SERVICE --}}
                        <div class="col-12">

                            <div class="prestation-detail-item">

                                <span class="prestation-detail-label">
                                    Service VLIFE
                                </span>

                                <strong class="prestation-detail-value">
                                    {{ $prestation->service->nom ?? 'Service non renseigné' }}
                                </strong>

                            </div>

                        </div>

                    </div>


                    {{-- ACTIONS DU BAS --}}
                    <div class="prestation-show-footer">

                        <a href="{{ route('prestations.index') }}"
                           class="btn btn-prestation-cancel">
                            Retour à la liste
                        </a>

                        <a href="{{ route('prestations.edit', $prestation->idPrestation) }}"
                           class="btn btn-vlife btn-save-prestation">
                            Modifier la prestation
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection