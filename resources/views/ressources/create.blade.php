@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Ajouter une ressource
            </h1>

            <p class="text-muted mb-0">
                Créer une nouvelle ressource pour un service VLIFE.
            </p>
        </div>

        <a href="{{ route('ressources.index') }}"
           class="btn btn-ressource-back">
            ← Retour aux ressources
        </a>

    </div>


    {{-- FORMULAIRE --}}
    <div class="row justify-content-center">

        <div class="col-lg-9 col-xl-8">

            <div class="card border-0 shadow-sm ressource-form-card">

                {{-- EN-TÊTE DU FORMULAIRE --}}
                <div class="ressource-form-header">

                    <div class="ressource-form-icon">
                        VL
                    </div>

                    <div>
                        <h4 class="mb-1">
                            Nouvelle ressource
                        </h4>

                        <p class="mb-0">
                            Renseignez les informations de la ressource.
                        </p>
                    </div>

                </div>


                <div class="card-body p-4 p-lg-5">

                    <form action="{{ route('ressources.store') }}"
                          method="POST">

                        @csrf

                        <div class="row g-4">

                            {{-- NOM --}}
                            <div class="col-md-6">

                                <label for="nom"
                                       class="form-label ressource-form-label">
                                    Nom de la ressource
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       id="nom"
                                       name="nom"
                                       value="{{ old('nom') }}"
                                       class="form-control ressource-input @error('nom') is-invalid @enderror"
                                       placeholder="Ex. Poste 1">

                                @error('nom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- TYPE --}}
                            <div class="col-md-6">

                                <label for="type"
                                       class="form-label ressource-form-label">
                                    Type de ressource
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       id="type"
                                       name="type"
                                       value="{{ old('type') }}"
                                       class="form-control ressource-input @error('type') is-invalid @enderror"
                                       placeholder="Ex. Poste de travail">

                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- ÉTAT --}}
                            <div class="col-md-6">

                                <label for="etat"
                                       class="form-label ressource-form-label">
                                    État
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="etat"
                                        id="etat"
                                        class="form-select ressource-input @error('etat') is-invalid @enderror">

                                    <option value="Disponible"
                                        {{ old('etat', 'Disponible') == 'Disponible' ? 'selected' : '' }}>
                                        Disponible
                                    </option>

                                    <option value="Occupée"
                                        {{ old('etat') == 'Occupée' ? 'selected' : '' }}>
                                        Occupée
                                    </option>

                                    <option value="Maintenance"
                                        {{ old('etat') == 'Maintenance' ? 'selected' : '' }}>
                                        Maintenance
                                    </option>

                                </select>

                                @error('etat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- CAPACITÉ --}}
                            <div class="col-md-6">

                                <label for="capacite"
                                       class="form-label ressource-form-label">
                                    Capacité
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="number"
                                       id="capacite"
                                       name="capacite"
                                       value="{{ old('capacite') }}"
                                       min="1"
                                       class="form-control ressource-input @error('capacite') is-invalid @enderror"
                                       placeholder="Ex. 1">

                                @error('capacite')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- SERVICE --}}
                            <div class="col-12">

                                <label for="idService"
                                       class="form-label ressource-form-label">
                                    Service VLIFE
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="idService"
                                        id="idService"
                                        class="form-select ressource-input @error('idService') is-invalid @enderror">

                                    <option value="">
                                        -- Sélectionner un service --
                                    </option>

                                    @foreach($services as $service)

                                        <option value="{{ $service->idService }}"
                                            {{ old('idService') == $service->idService ? 'selected' : '' }}>

                                            {{ $service->nom }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('idService')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- DESCRIPTION --}}
                            <div class="col-12">

                                <label for="description"
                                       class="form-label ressource-form-label">
                                    Description
                                </label>

                                <textarea name="description"
                                          id="description"
                                          rows="5"
                                          class="form-control ressource-input @error('description') is-invalid @enderror"
                                          placeholder="Décrivez la ressource...">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- ACTIONS --}}
                        <div class="ressource-form-actions">

                            <a href="{{ route('ressources.index') }}"
                               class="btn btn-ressource-cancel">
                                Annuler
                            </a>

                            <button type="submit"
                                    class="btn btn-vlife btn-save-ressource">
                                ✓ Enregistrer la ressource
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection