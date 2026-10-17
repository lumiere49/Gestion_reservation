@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Gestion des utilisateurs
            </h2>

            <p class="text-muted mb-0">
                Gestion des administrateurs, responsables et employés VLIFE
            </p>
        </div>

        <a href="{{ route('utilisateurs.create') }}"
           class="btn btn-primary">

            + Nouvel utilisateur

        </a>

    </div>


    {{-- MESSAGES --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    {{-- ERREURS --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- TABLEAU --}}
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Nom</th>

                            <th>Prénom</th>

                            <th>Email</th>

                            <th>Téléphone</th>

                            <th>Rôle</th>

                            <th>Service</th>

                            <th class="text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($utilisateurs as $utilisateur)

                            <tr>

                                <td>
                                    {{ $utilisateur->idUtilisateur }}
                                </td>

                                <td>
                                    {{ $utilisateur->nom }}
                                </td>

                                <td>
                                    {{ $utilisateur->prenom }}
                                </td>

                                <td>
                                    {{ $utilisateur->email }}
                                </td>

                                <td>
                                    {{ $utilisateur->telephone ?? '-' }}
                                </td>

                                <td>

                                    @if($utilisateur->role === 'Administrateur')

                                        <span class="badge bg-danger">
                                            Administrateur
                                        </span>

                                    @elseif($utilisateur->role === 'Responsable')

                                        <span class="badge bg-warning text-dark">
                                            Responsable
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Employé
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($utilisateur->service)

                                        {{ $utilisateur->service->nom }}

                                    @else

                                        <span class="text-muted">
                                            Tous les services
                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    <a href="{{ route('utilisateurs.edit', $utilisateur->idUtilisateur) }}"
                                       class="btn btn-sm btn-outline-primary">

                                        Modifier

                                    </a>

                                    @if($utilisateur->idUtilisateur != 1)

                                        <form action="{{ route('utilisateurs.destroy', $utilisateur->idUtilisateur) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">

                                                Supprimer

                                            </button>

                                        </form>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="text-center text-muted py-4">

                                    Aucun utilisateur enregistré.

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