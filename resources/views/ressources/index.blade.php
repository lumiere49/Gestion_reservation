@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Ressources VLIFE
            </h1>

            <p class="text-muted mb-0">
                Gestion des ressources utilisées pour les réservations.
            </p>
        </div>

        <a href="{{ route('ressources.create') }}"
           class="btn btn-vlife">
            + Ajouter une ressource
        </a>

    </div>


    {{-- MESSAGES --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- TABLEAU --}}
    <div class="card border-0 shadow-sm ressource-table-card">

        <div class="card-header ressource-table-header">

            <div>

                <h5 class="mb-1 fw-bold">
                    Liste des ressources
                </h5>

                <span>
                    Ressources disponibles dans les différents services VLIFE
                </span>

            </div>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Ressource</th>
                            <th>Type</th>
                            <th>État</th>
                            <th>Capacité</th>
                            <th>Description</th>
                            <th class="text-center">Actions</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($ressources as $ressource)

                        <tr>

                            {{-- ID --}}
                            <td>

                                <span class="ressource-id">
                                    #{{ $ressource->idRessource }}
                                </span>

                            </td>


                            {{-- SERVICE --}}
                            <td>

                                <div class="ressource-service">

                                    <div class="ressource-service-icon">
                                        VL
                                    </div>

                                    <strong>
                                        {{ $ressource->service->nom ?? 'Service non renseigné' }}
                                    </strong>

                                </div>

                            </td>


                            {{-- NOM --}}
                            <td>

                                <strong class="ressource-name">
                                    {{ $ressource->nom }}
                                </strong>

                            </td>


                            {{-- TYPE --}}
                            <td>

                                <span class="ressource-type">
                                    {{ $ressource->type }}
                                </span>

                            </td>


                            {{-- ÉTAT --}}
                            <td>

                                <span class="ressource-status">
                                    {{ $ressource->etat }}
                                </span>

                            </td>


                            {{-- CAPACITÉ --}}
                            <td>

                                <span class="ressource-capacity">
                                    {{ $ressource->capacite }}
                                </span>

                            </td>


                            {{-- DESCRIPTION --}}
                            <td>

                                <span class="ressource-description">
                                    {{ $ressource->description }}
                                </span>

                            </td>


                            {{-- ACTIONS --}}
<td>

    <div class="ressource-actions">

        {{-- Voir : accessible à tous --}}
        <a href="{{ route('ressources.show', $ressource->idRessource) }}"
           class="btn btn-ressource-view btn-sm">
            Voir
        </a>

        {{-- Modifier et Supprimer : interdits aux employés --}}
        @if(auth()->user()->role !== 'Employe')

            <a href="{{ route('ressources.edit', $ressource->idRessource) }}"
               class="btn btn-ressource-edit btn-sm">
                Modifier
            </a>

            <form action="{{ route('ressources.destroy', $ressource->idRessource) }}"
                  method="POST"
                  class="m-0"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette ressource ?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-ressource-delete btn-sm">
                    Supprimer
                </button>

            </form>

        @endif

    </div>

</td>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="8">

                                <div class="ressource-empty">

                                    <div class="ressource-empty-icon">
                                        VL
                                    </div>

                                    <h5>
                                        Aucune ressource enregistrée
                                    </h5>

                                    <p>
                                        Commencez par ajouter une ressource.
                                    </p>

                                    <a href="{{ route('ressources.create') }}"
                                       class="btn btn-vlife">
                                        + Ajouter une ressource
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