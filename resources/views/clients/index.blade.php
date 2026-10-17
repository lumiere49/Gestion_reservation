@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Clients VLIFE</h1>
            <p class="text-muted mb-0">
                Gestion des clients du portail unifié de réservation.
            </p>
        </div>

        <a href="/clients/create" class="btn btn-vlife">
            + Nouveau client
        </a>

    </div>


    <!-- MESSAGE DE SUCCÈS -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>

    @endif


    <!-- CARTE CLIENTS -->
    <div class="card border-0 shadow-sm client-table-card">

        <!-- EN-TÊTE DE LA CARTE -->
        <div class="card-header client-table-header">

            <div>
                <h5 class="mb-1 fw-bold">
                    Liste des clients
                </h5>

                <span>
                    Clients enregistrés dans le portail VLIFE
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
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th class="text-center">Actions</th>
                        </tr>

                    </thead>


                    <tbody>

                    @forelse($clients as $client)

                        <tr>

                            <!-- ID -->
                            <td>
                                <span class="client-id">
                                    #{{ $client->idClient }}
                                </span>
                            </td>


                            <!-- CLIENT -->
                            <td>

                                <div class="client-information">

                                    <div class="client-avatar">
                                        {{ strtoupper(substr($client->prenom, 0, 1)) }}
                                    </div>

                                    <div>

                                        <strong class="client-name">
                                            {{ $client->nom }} {{ $client->prenom }}
                                        </strong>

                                        <span class="client-reference">
                                            Client VLIFE
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <!-- EMAIL -->
                            <td>

                                <span class="client-email">
                                    {{ $client->email ?: 'Non renseigné' }}
                                </span>

                            </td>


                            <!-- TELEPHONE -->
                            <td>

                                <span class="client-phone">
                                    {{ $client->telephone ?: 'Non renseigné' }}
                                </span>

                            </td>


                            <!-- ADRESSE -->
                            <td>

                                <span class="client-address">
                                    {{ $client->adresse ?: 'Non renseignée' }}
                                </span>

                            </td>


                            <!-- ACTIONS -->
                            <td>

                                <div class="client-actions">

    <a href="/clients/{{ $client->idClient }}"
       class="btn btn-client-view btn-sm">
        Voir
    </a>

    <a href="/clients/{{ $client->idClient }}/edit"
       class="btn btn-client-edit btn-sm">
        Modifier
    </a>

    <form action="/clients/{{ $client->idClient }}"
          method="POST"
          class="m-0"
          onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?');">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-client-delete btn-sm">
            Supprimer
        </button>

    </form>

</div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="client-empty">

                                    <div class="client-empty-icon">
                                        VL
                                    </div>

                                    <h5>
                                        Aucun client enregistré
                                    </h5>

                                    <p>
                                        Aucun client n'est actuellement enregistré dans le portail.
                                    </p>

                                    <a href="{{ route('clients.create') }}"
                                       class="btn btn-vlife">
                                        + Ajouter un client
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