@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Prestations VLIFE</h1>

            <p class="text-muted mb-0">
                Gestion des prestations proposées par les différents services.
            </p>
        </div>

        <a href="{{ route('prestations.create') }}" class="btn btn-vlife">
            + Ajouter une prestation
        </a>

    </div>


    {{-- MESSAGES --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- TABLEAU --}}
    <div class="card border-0 shadow-sm prestation-table-card">

        <div class="card-header prestation-table-header">

            <div>
                <h5 class="mb-1 fw-bold">
                    Liste des prestations
                </h5>

                <span>
                    Prestations disponibles dans les services VLIFE
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
                            <th>Prestation</th>
                            <th>Prix</th>
                            <th>Durée</th>
                            <th>Description</th>
                            <th class="text-center">Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($prestations as $prestation)

                        <tr>

                            {{-- ID --}}
                            <td>

                                <span class="prestation-id">
                                    #{{ $prestation->idPrestation }}
                                </span>

                            </td>


                            {{-- SERVICE --}}
                            <td>

                                <div class="prestation-service">

                                    <div class="prestation-service-icon">
                                        VL
                                    </div>

                                    <strong>
                                        {{ $prestation->service->nom }}
                                    </strong>

                                </div>

                            </td>


                            {{-- NOM --}}
                            <td>

                                <strong class="prestation-name">
                                    {{ $prestation->nom }}
                                </strong>

                            </td>


                            {{-- PRIX --}}
                            <td>

                                <span class="prestation-price">
                                    {{ number_format($prestation->prix, 0, ',', ' ') }} FCFA
                                </span>

                            </td>


                            {{-- DURÉE --}}
                            <td>

                                <span class="prestation-duration">
                                    {{ $prestation->duree }}
                                </span>

                            </td>


                            {{-- DESCRIPTION --}}
                            <td>

                                <span class="prestation-description">

                                    {{ $prestation->description }}

                                </span>

                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                <div class="prestation-actions">

                                    <a href="{{ route('prestations.show', $prestation->idPrestation) }}"
                                       class="btn btn-prestation-view btn-sm">

                                        Voir

                                    </a>


                                    <a href="{{ route('prestations.edit', $prestation->idPrestation) }}"
                                       class="btn btn-prestation-edit btn-sm">

                                        Modifier

                                    </a>


                                    <form action="{{ route('prestations.destroy', $prestation->idPrestation) }}"
                                          method="POST"
                                          class="m-0"
                                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette prestation ?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-prestation-delete btn-sm">

                                            Supprimer

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                        @empty

                        <tr>

                            <td colspan="7">

                                <div class="prestation-empty">

                                    <div class="prestation-empty-icon">
                                        VL
                                    </div>

                                    <h5>Aucune prestation enregistrée</h5>

                                    <p>
                                        Commencez par ajouter une prestation.
                                    </p>

                                    <a href="{{ route('prestations.create') }}"
                                       class="btn btn-vlife">

                                        + Ajouter une prestation

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