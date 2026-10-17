@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Ajouter un client</h1>

            <p class="text-muted mb-0">
                Enregistrer un nouveau client dans le portail VLIFE.
            </p>
        </div>

        <a href="/clients" class="btn btn-client-back">
            ← Retour aux clients
        </a>

    </div>


    <!-- FORMULAIRE -->
    <div class="row justify-content-center">

        <div class="col-lg-9 col-xl-8">

            <div class="card border-0 shadow-sm client-form-card">

                <!-- EN-TÊTE DU FORMULAIRE -->
                <div class="client-form-header">

                    <div class="client-form-icon">
                        VL
                    </div>

                    <div>
                        <h4 class="mb-1">
                            Nouveau client
                        </h4>

                        <p class="mb-0">
                            Renseignez les informations du client.
                        </p>
                    </div>

                </div>


                <!-- CORPS -->
                <div class="card-body p-4 p-lg-5">

                    {{-- ERREURS DE VALIDATION --}}
                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <strong>
                                Veuillez corriger les erreurs suivantes :
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form action="/clients" method="POST">

                        @csrf


                        <div class="row g-4">

                            <!-- NOM -->
                            <div class="col-md-6">

                                <label for="nom" class="client-form-label">
                                    Nom
                                </label>

                                <input
                                    type="text"
                                    id="nom"
                                    name="nom"
                                    value="{{ old('nom') }}"
                                    class="form-control client-input"
                                    placeholder="Ex. ANABA"
                                    required
                                >

                            </div>


                            <!-- PRÉNOM -->
                            <div class="col-md-6">

                                <label for="prenom" class="client-form-label">
                                    Prénom
                                </label>

                                <input
                                    type="text"
                                    id="prenom"
                                    name="prenom"
                                    value="{{ old('prenom') }}"
                                    class="form-control client-input"
                                    placeholder="Ex. Béatrice"
                                    required
                                >

                            </div>


                            <!-- EMAIL -->
                            <div class="col-md-6">

                                <label for="email" class="client-form-label">
                                    Email
                                </label>

                                <input
                                   type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control client-input"
                                   placeholder="Ex. client@email.com"
                                    required
                               >

                            </div>


                            <!-- TÉLÉPHONE -->
                            <div class="col-md-6">

                                <label for="telephone" class="client-form-label">
                                    Téléphone
                                </label>

                                <input
                                    type="text"
                                    id="telephone"
                                    name="telephone"
                                    value="{{ old('telephone') }}"
                                    class="form-control client-input"
                                    placeholder="Ex. 6XX XX XX XX"
                                >

                            </div>


                            <!-- ADRESSE -->
                            <div class="col-12">

                                <label for="adresse" class="client-form-label">
                                    Adresse
                                </label>

                                <input
                                    type="text"
                                    id="adresse"
                                    name="adresse"
                                    value="{{ old('adresse') }}"
                                    class="form-control client-input"
                                    placeholder="Ex. Yaoundé, Cameroun"
                                >

                            </div>


                          <!-- MOT DE PASSE -->
                     <div class="col-12">

                    <label for="mot_de_passe" class="client-form-label">
        Mot de passe
                 </label>

                 <input
        type="password"
        id="mot_de_passe"
        name="mot_de_passe"
        class="form-control client-input"
        placeholder="Saisissez le mot de passe du client"
        minlength="6"
        required
    >

    <small class="client-form-help">
        Le mot de passe doit contenir au moins 6 caractères.
    </small>

    @error('mot_de_passe')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
    @enderror

</div>


                        <!-- ACTIONS -->
                        <div class="client-form-actions">

                            <a href="/clients"
                               class="btn btn-client-cancel">
                                Annuler
                            </a>

                            <button type="submit"
                                    class="btn btn-vlife btn-save-client">
                                ✓ Enregistrer le client
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection