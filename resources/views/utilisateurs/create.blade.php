@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Nouvel utilisateur
            </h2>

            <p class="text-muted mb-0">
                Créer un compte administrateur, responsable ou employé
            </p>
        </div>

        <a href="{{ route('utilisateurs.index') }}"
           class="btn btn-outline-secondary">

            ← Retour

        </a>

    </div>


    {{-- ERREURS DE VALIDATION --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Veuillez corriger les erreurs suivantes :</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORMULAIRE --}}
    <div class="card shadow-sm border-0">

        <div class="card-body p-4">

            <form action="{{ route('utilisateurs.store') }}"
                  method="POST">

                @csrf


                {{-- INFORMATIONS PERSONNELLES --}}
                <h5 class="fw-bold mb-3">
                    Informations personnelles
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Nom *
                        </label>

                        <input type="text"
                               name="nom"
                               value="{{ old('nom') }}"
                               class="form-control"
                               required>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Prénom *
                        </label>

                        <input type="text"
                               name="prenom"
                               value="{{ old('prenom') }}"
                               class="form-control"
                               required>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Email *
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control"
                               required>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Téléphone
                        </label>

                        <input type="text"
                               name="telephone"
                               value="{{ old('telephone') }}"
                               class="form-control">

                    </div>


                    <div class="col-12">

                        <label class="form-label">
                            Adresse
                        </label>

                        <input type="text"
                               name="adresse"
                               value="{{ old('adresse') }}"
                               class="form-control">

                    </div>

                </div>


                <hr class="my-4">


                {{-- RÔLE ET SERVICE --}}
                <h5 class="fw-bold mb-3">
                    Fonction et affectation
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Rôle *
                        </label>

                        <select name="role"
                                id="role"
                                class="form-select"
                                required>

                            <option value="">
                                -- Sélectionner un rôle --
                            </option>

                            <option value="Administrateur"
                                {{ old('role') === 'Administrateur' ? 'selected' : '' }}>
                                Administrateur général
                            </option>

                            <option value="Responsable"
                                {{ old('role') === 'Responsable' ? 'selected' : '' }}>
                                Responsable de service
                            </option>

                            <option value="Employe"
                                {{ old('role') === 'Employe' ? 'selected' : '' }}>
                                Employé
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Service
                        </label>

                        <select name="idService"
                                id="idService"
                                class="form-select">

                            <option value="">
                                -- Aucun service --
                            </option>

                            @foreach($services as $service)

                                <option value="{{ $service->idService }}"
                                    {{ old('idService') == $service->idService ? 'selected' : '' }}>

                                    {{ $service->nom }}

                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">
                            Obligatoire pour un Responsable ou un Employé.
                        </small>

                    </div>

                </div>


                <hr class="my-4">


                {{-- MOT DE PASSE --}}
                <h5 class="fw-bold mb-3">
                    Sécurité du compte
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Mot de passe *
                        </label>

                        <input type="password"
                               name="mot_de_passe"
                               class="form-control"
                               required>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Confirmer le mot de passe *
                        </label>

                        <input type="password"
                               name="mot_de_passe_confirmation"
                               class="form-control"
                               required>

                    </div>

                </div>


                <div class="alert alert-info mt-4">

                    <strong>Politique VLIFE :</strong>

                    Tous les employés peuvent créer une réservation
                    pour n'importe quel service de VLIFE, quel que soit
                    leur service d'affectation.

                </div>


                {{-- BOUTONS --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('utilisateurs.index') }}"
                       class="btn btn-secondary">

                        Annuler

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        Créer l'utilisateur

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- GESTION AUTOMATIQUE DU SERVICE --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const role = document.getElementById('role');
    const service = document.getElementById('idService');

    function gererService() {

        if (role.value === 'Administrateur') {

            service.value = '';
            service.disabled = true;
            service.required = false;

        } else {

            service.disabled = false;
            service.required = true;

        }
    }

    role.addEventListener('change', gererService);

    gererService();

});

</script>

@endsection
