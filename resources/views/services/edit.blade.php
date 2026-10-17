@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Modifier un service</h2>
            <p class="text-muted mb-0">
                Modifier les informations du service
            </p>
        </div>

        <a href="/services" class="btn btn-secondary">
            ← Retour
        </a>

    </div>

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

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="/services/{{ $service->idService }}" method="POST">

                @csrf
                @method('PUT')

                {{-- Nom --}}
                <div class="mb-3">
                    <label for="nom" class="form-label">
                        Nom du service
                    </label>

                    <input
                        type="text"
                        name="nom"
                        id="nom"
                        class="form-control"
                        value="{{ old('nom', $service->nom) }}"
                        required
                    >
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        rows="4"
                    >{{ old('description', $service->description) }}</textarea>
                </div>

                {{-- Téléphone --}}
                <div class="mb-3">
                    <label for="telephone" class="form-label">
                        Téléphone
                    </label>

                    <input
                        type="text"
                        name="telephone"
                        id="telephone"
                        class="form-control"
                        value="{{ old('telephone', $service->telephone) }}"
                        required
                    >
                </div>

                {{-- Adresse --}}
                <div class="mb-3">
                    <label for="adresse" class="form-label">
                        Adresse
                    </label>

                    <input
                        type="text"
                        name="adresse"
                        id="adresse"
                        class="form-control"
                        value="{{ old('adresse', $service->adresse) }}"
                        required
                    >
                </div>

                <div class="row">

                    {{-- Heure ouverture --}}
                    <div class="col-md-6 mb-3">

                        <label for="heure_ouverture" class="form-label">
                            Heure d'ouverture
                        </label>

                        <input
                            type="time"
                            name="heure_ouverture"
                            id="heure_ouverture"
                            class="form-control"
                            value="{{ old('heure_ouverture', $service->heure_ouverture) }}"
                            required
                        >

                    </div>

                    {{-- Heure fermeture --}}
                    <div class="col-md-6 mb-3">

                        <label for="heure_fermeture" class="form-label">
                            Heure de fermeture
                        </label>

                        <input
                            type="time"
                            name="heure_fermeture"
                            id="heure_fermeture"
                            class="form-control"
                            value="{{ old('heure_fermeture', $service->heure_fermeture) }}"
                            required
                        >

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="/services" class="btn btn-secondary">
                        Annuler
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Modifier
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection