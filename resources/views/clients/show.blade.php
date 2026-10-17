@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Détails du client</h1>

            <p class="text-muted mb-0">
                Consultez les informations détaillées de ce client.
            </p>
        </div>

        <div class="client-show-actions">

            <a href="/clients" class="btn btn-client-back">
                ← Retour aux clients
            </a>

            <a href="/clients/{{ $client->idClient }}/edit"
               class="btn btn-client-edit">
                Modifier
            </a>

        </div>

    </div>


    <!-- CARTE CLIENT -->
    <div class="row justify-content-center">

        <div class="col-lg-9 col-xl-8">

            <div class="card border-0 shadow-sm client-show-card">

                <!-- EN-TÊTE -->
                <div class="client-show-header">

                    <div class="client-show-avatar">
                        {{ strtoupper(substr($client->prenom, 0, 1)) }}
                    </div>

                    <div>

                        <span class="client-show-label">
                            CLIENT VLIFE
                        </span>

                        <h2 class="mb-1">
                            {{ $client->nom }} {{ $client->prenom }}
                        </h2>

                        <p class="mb-0">
                            Référence #{{ $client->idClient }}
                        </p>

                    </div>

                </div>


                <!-- INFORMATIONS -->
                <div class="card-body p-4 p-lg-5">

                    <div class="row g-4">

                        <!-- ID -->
                        <div class="col-md-6">

                            <div class="client-detail-item">

                                <span class="client-detail-label">
                                    ID client
                                </span>

                                <strong class="client-detail-value client-detail-id">
                                    #{{ $client->idClient }}
                                </strong>

                            </div>

                        </div>


                        <!-- NOM -->
                        <div class="col-md-6">

                            <div class="client-detail-item">

                                <span class="client-detail-label">
                                    Nom
                                </span>

                                <strong class="client-detail-value">
                                    {{ $client->nom }}
                                </strong>

                            </div>

                        </div>


                        <!-- PRÉNOM -->
                        <div class="col-md-6">

                            <div class="client-detail-item">

                                <span class="client-detail-label">
                                    Prénom
                                </span>

                                <strong class="client-detail-value">
                                    {{ $client->prenom }}
                                </strong>

                            </div>

                        </div>


                        <!-- EMAIL -->
                        <div class="col-md-6">

                            <div class="client-detail-item">

                                <span class="client-detail-label">
                                    Email
                                </span>

                                <strong class="client-detail-value">
                                    {{ $client->email ?: 'Non renseigné' }}
                                </strong>

                            </div>

                        </div>


                        <!-- TÉLÉPHONE -->
                        <div class="col-md-6">

                            <div class="client-detail-item">

                                <span class="client-detail-label">
                                    Téléphone
                                </span>

                                <strong class="client-detail-value">
                                    {{ $client->telephone ?: 'Non renseigné' }}
                                </strong>

                            </div>

                        </div>


                        <!-- ADRESSE -->
                        <div class="col-md-6">

                            <div class="client-detail-item">

                                <span class="client-detail-label">
                                    Adresse
                                </span>

                                <strong class="client-detail-value">
                                    {{ $client->adresse ?: 'Non renseignée' }}
                                </strong>

                            </div>

                        </div>

                    </div>


                    <!-- PIED DE CARTE -->
                    <div class="client-show-footer">

                        <a href="/clients"
                           class="btn btn-client-cancel">
                            Retour à la liste
                        </a>

                        <a href="/clients/{{ $client->idClient }}/edit"
                           class="btn btn-vlife btn-save-client">
                            Modifier le client
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection