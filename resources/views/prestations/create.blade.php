@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Ajouter une prestation</h1>

            <p class="text-muted mb-0">
                Créer une nouvelle prestation pour un service VLIFE.
            </p>
        </div>

        <a href="{{ route('prestations.index') }}"
           class="btn btn-prestation-back">

            ← Retour aux prestations

        </a>

    </div>


    {{-- FORMULAIRE --}}
    <div class="row justify-content-center">

        <div class="col-lg-9 col-xl-8">

            <div class="card border-0 shadow-sm prestation-form-card">

                {{-- EN-TÊTE --}}
                <div class="prestation-form-header">

                    <div class="prestation-form-icon">
                        VL
                    </div>

                    <div>
                        <h4 class="mb-1">
                            Nouvelle prestation
                        </h4>

                        <p class="mb-0">
                            Renseignez les informations de la prestation.
                        </p>
                    </div>

                </div>


                {{-- CORPS --}}
                <div class="card-body p-4 p-lg-5">

                    <form action="{{ route('prestations.store') }}"
                          method="POST">

                        @csrf


                        <div class="row g-4">


                            {{-- NOM --}}
                            <div class="col-md-6">

                                <label for="nom"
                                       class="form-label prestation-form-label">

                                    Nom de la prestation
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="text"
                                       id="nom"
                                       name="nom"
                                       value="{{ old('nom') }}"
                                       class="form-control prestation-input @error('nom') is-invalid @enderror"
                                       placeholder="Ex. Coupe homme">

                                @error('nom')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- PRIX --}}
                            <div class="col-md-6">

                                <label for="prix"
                                       class="form-label prestation-form-label">

                                    Prix
                                    <span class="text-danger">*</span>

                                </label>

                                <div class="input-group">

                                    <input type="number"
                                           id="prix"
                                           name="prix"
                                           value="{{ old('prix') }}"
                                           class="form-control prestation-input @error('prix') is-invalid @enderror"
                                           placeholder="Ex. 5000"
                                           min="0">

                                    <span class="input-group-text prestation-unit">
                                        FCFA
                                    </span>

                                </div>

                                @error('prix')

                                    <div class="text-danger prestation-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- DURÉE --}}
                            <div class="col-md-6">

                                <label for="duree"
                                       class="form-label prestation-form-label">

                                    Durée
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="text"
                                       id="duree"
                                       name="duree"
                                       value="{{ old('duree') }}"
                                       class="form-control prestation-input @error('duree') is-invalid @enderror"
                                       placeholder="Ex. 45 minutes">

                                @error('duree')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- SERVICE --}}
                            <div class="col-md-6">

                                <label for="idService"
                                       class="form-label prestation-form-label">

                                    Service VLIFE
                                    <span class="text-danger">*</span>

                                </label>

                                <select name="idService"
                                        id="idService"
                                        class="form-select prestation-input @error('idService') is-invalid @enderror">

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
                                       class="form-label prestation-form-label">

                                    Description

                                </label>

                                <textarea name="description"
                                          id="description"
                                          rows="5"
                                          class="form-control prestation-input @error('description') is-invalid @enderror"
                                          placeholder="Décrivez la prestation...">{{ old('description') }}</textarea>

                                @error('description')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>


                        {{-- BOUTONS --}}
                        <div class="prestation-form-actions">

                            <a href="{{ route('prestations.index') }}"
                               class="btn btn-prestation-cancel">

                                Annuler

                            </a>

                            <button type="submit"
                                    class="btn btn-vlife">

                                ✓ Enregistrer la prestation

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection