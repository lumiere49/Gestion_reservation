@extends('layouts.public')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">

        <h1 class="fw-bold" style="color:#8B0038;">
            Réserver un service VLIFE
        </h1>

        <p class="text-muted">
            Remplissez le formulaire ci-dessous pour effectuer votre demande de réservation.
        </p>

    </div>


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


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4 p-lg-5">

            <form
                action="{{ route('reservation.public.store') }}"
                method="POST"
            >

                @csrf


                {{-- INFORMATIONS CLIENT --}}

                <h4 class="fw-bold mb-4" style="color:#8B0038;">
                    1. Vos informations
                </h4>

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nom
                        </label>

                        <input
                            type="text"
                            name="nom"
                            value="{{ old('nom') }}"
                            class="form-control"
                            required
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Prénom
                        </label>

                        <input
                            type="text"
                            name="prenom"
                            value="{{ old('prenom') }}"
                            class="form-control"
                            required
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Téléphone
                        </label>

                        <input
                            type="text"
                            name="telephone"
                            value="{{ old('telephone') }}"
                            class="form-control"
                            required
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Adresse email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                            required
                        >

                    </div>

                </div>


                {{-- RESERVATION --}}

                <h4
                    class="fw-bold mb-4 mt-5"
                    style="color:#8B0038;"
                >
                    2. Votre réservation
                </h4>


                <div class="row g-4">


                    {{-- SERVICE --}}

                    <div class="col-md-6">

                        <label
                            for="service"
                            class="form-label fw-semibold"
                        >
                            Service
                        </label>

                        <select
                            name="idService"
                            id="service"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Choisir un service --
                            </option>

                            @foreach($services as $service)

                                <option
                                      value="{{ $service->idService }}"
                                       {{ old('idService') == $service->idService ? 'selected' : '' }}
                                    >
                                      {{ $service->nom }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- PRESTATION --}}

                    <div class="col-md-6">

                        <label
                            for="prestation"
                            class="form-label fw-semibold"
                        >
                            Prestation
                        </label>

                        <select
    name="idPrestation"
    id="prestation"
    class="form-select"
    required
>
    <option value="">-- Choisir d'abord un service --</option>

    @foreach($prestations as $prestation)
        <option
            value="{{ $prestation->idPrestation }}"
            data-service="{{ $prestation->idService }}"
            {{ old('idPrestation') == $prestation->idPrestation ? 'selected' : '' }}
        >
            {{ $prestation->nom }} - {{ number_format($prestation->prix, 0, ',', ' ') }} FCFA
        </option>
    @endforeach
</select>

                    </div>


                    {{-- DATE --}}

                    <div class="col-md-4">

                        <label
                            for="date_reservation"
                            class="form-label fw-semibold"
                        >
                            Date
                        </label>

                        <input
                            type="date"
                            name="date_reservation"
                            id="date_reservation"
                            value="{{ old('date_reservation') }}"
                            class="form-control"
                            required
                        >

                    </div>


                    {{-- HEURE DEBUT --}}

                    <div class="col-md-4">

                        <label
                            for="heure_debut"
                            class="form-label fw-semibold"
                        >
                            Heure de début
                        </label>

                        <input
                            type="time"
                            name="heure_debut"
                            id="heure_debut"
                            value="{{ old('heure_debut') }}"
                            class="form-control"
                            required
                        >

                    </div>


                    {{-- HEURE FIN --}}

                    <div class="col-md-4">

                        <label
                            for="heure_fin"
                            class="form-label fw-semibold"
                        >
                            Heure de fin
                        </label>

                        <input
                            type="time"
                            name="heure_fin"
                            id="heure_fin"
                            value="{{ old('heure_fin') }}"
                            class="form-control"
                            required
                        >

                    </div>

                </div>


                <div class="mt-5 d-flex justify-content-between">

                    <a
                        href="{{ url('/') }}"
                        class="btn btn-outline-secondary"
                    >
                        ← Retour
                    </a>


                    <button
                        type="submit"
                        class="btn"
                        style="
                            background:linear-gradient(
                                135deg,
                                #8B0038,
                                #333333
                            );
                            color:white;
                            padding:12px 25px;
                            border-radius:25px;
                        "
                    >
                        Confirmer ma réservation
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const serviceSelect = document.getElementById('service');
    const prestationSelect = document.getElementById('prestation');

    function filtrerPrestations() {

        const serviceId = serviceSelect.value;

        Array.from(prestationSelect.options).forEach(function (option) {

            if (option.value === '') {
                option.hidden = false;
                return;
            }

            option.hidden = option.dataset.service !== serviceId;
        });

        // Réinitialiser la prestation
        prestationSelect.value = '';

        if (serviceId === '') {
            prestationSelect.options[0].textContent =
                '-- Choisir d’abord un service --';
        } else {
            prestationSelect.options[0].textContent =
                '-- Choisir une prestation --';
        }
    }

    serviceSelect.addEventListener('change', filtrerPrestations);

    // Si une ancienne valeur existe après une erreur de validation
    if (serviceSelect.value !== '') {

        const anciennePrestation = "{{ old('idPrestation') }}";

        Array.from(prestationSelect.options).forEach(function (option) {

            if (option.value === '') {
                return;
            }

            option.hidden =
                option.dataset.service !== serviceSelect.value;
        });

        if (anciennePrestation !== '') {
            prestationSelect.value = anciennePrestation;
        }
    }

});
</script>

@endsection