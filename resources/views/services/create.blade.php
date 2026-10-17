@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1>Ajouter un service</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du service</label>
            <input
                type="text"
                name="nom"
                id="nom"
                class="form-control"
                value="{{ old('nom') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                name="description"
                id="description"
                class="form-control"
                rows="3"
            >{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input
                type="text"
                name="telephone"
                id="telephone"
                class="form-control"
                value="{{ old('telephone') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input
                type="text"
                name="adresse"
                id="adresse"
                class="form-control"
                value="{{ old('adresse') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="heure_ouverture" class="form-label">
                Heure d'ouverture
            </label>

            <input
                type="time"
                name="heure_ouverture"
                id="heure_ouverture"
                class="form-control"
                value="{{ old('heure_ouverture') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="heure_fermeture" class="form-label">
                Heure de fermeture
            </label>

            <input
                type="time"
                name="heure_fermeture"
                id="heure_fermeture"
                class="form-control"
                value="{{ old('heure_fermeture') }}"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Enregistrer
        </button>

        <a href="{{ route('services.index') }}" class="btn btn-secondary">
            Annuler
        </a>

    </form>

</div>

@endsection