@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Modifier une réservation</h1>

            <p class="text-muted mb-0">
                Modification de la réservation
                <strong>#{{ $reservation->idReservation }}</strong>.
            </p>
        </div>

        <a href="{{ route('reservations.index') }}"
           class="btn btn-reservation-back">
            ← Retour aux réservations
        </a>

    </div>


    <!-- FORMULAIRE -->
    <div class="row justify-content-center">

        <div class="col-lg-10 col-xl-9">

            <div class="card border-0 shadow-sm reservation-form-card">

                <!-- EN-TÊTE -->
                <div class="reservation-form-header">

                    <div class="reservation-form-icon">
                        VL
                    </div>

                    <div>
                        <h4 class="mb-1">
                            Modifier la réservation
                        </h4>

                        <p class="mb-0">
                            Mettez à jour les informations de cette réservation.
                        </p>
                    </div>

                </div>


                <!-- CORPS -->
                <div class="card-body p-4 p-lg-5">

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


                    <form
                        action="{{ route('reservations.update', $reservation->idReservation) }}"
                        method="POST">

                        @csrf
                        @method('PUT')


                        <!-- SECTION 1 -->

                        <div class="reservation-section-title">

                            <span class="reservation-section-number">
                                1
                            </span>

                            <div>
                                <h5>Informations de réservation</h5>

                                <p>
                                    Client et service associés à la réservation.
                                </p>
                            </div>

                        </div>


                        <div class="row g-4">


                            <!-- CLIENT -->

                            <div class="col-md-6">

                                <label
                                    for="idClient"
                                    class="reservation-form-label">
                                    Client
                                </label>

                                <select
                                    name="idClient"
                                    id="idClient"
                                    class="form-select reservation-input"
                                    required>

                                    @foreach($clients as $client)

                                        <option
                                            value="{{ $client->idClient }}"
                                            @if($client->idClient == $reservation->idClient)
                                                selected
                                            @endif>

                                            {{ $client->nom }}
                                            {{ $client->prenom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <!-- SERVICE -->

                            <div class="col-md-6">

                                <label
                                    for="idService"
                                    class="reservation-form-label">
                                    Service
                                </label>

                                <select
                                    name="idService"
                                    id="idService"
                                    class="form-select reservation-input"
                                    required>

                                    @foreach($services as $service)

                                        <option
                                            value="{{ $service->idService }}"
                                            @if($service->idService == $reservation->idService)
                                                selected
                                            @endif>

                                            {{ $service->nom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        <!-- SECTION 2 -->

                        <div class="reservation-section-title mt-5">

                            <span class="reservation-section-number">
                                2
                            </span>

                            <div>

                                <h5>Planification</h5>

                                <p>
                                    Date et horaires de la réservation.
                                </p>

                            </div>

                        </div>


                        <div class="row g-4">


                            <!-- DATE -->

                            <div class="col-md-4">

                                <label
                                    for="date_reservation"
                                    class="reservation-form-label">
                                    Date
                                </label>

                                <input
                                    type="date"
                                    id="date_reservation"
                                    name="date_reservation"
                                    value="{{ $reservation->date_reservation }}"
                                    class="form-control reservation-input"
                                    required
                                >

                            </div>


                            <!-- HEURE DÉBUT -->

                            <div class="col-md-4">

                                <label
                                    for="heure_debut"
                                    class="reservation-form-label">
                                    Heure de début
                                </label>

                                <input
                                    type="time"
                                    id="heure_debut"
                                    name="heure_debut"
                                    value="{{ $reservation->heure_debut }}"
                                    class="form-control reservation-input"
                                    required
                                >

                            </div>


                            <!-- HEURE FIN -->

                            <div class="col-md-4">

                                <label
                                    for="heure_fin"
                                    class="reservation-form-label">
                                    Heure de fin
                                </label>

                                <input
                                    type="time"
                                    id="heure_fin"
                                    name="heure_fin"
                                    value="{{ $reservation->heure_fin }}"
                                    class="form-control reservation-input"
                                    required
                                >

                            </div>

                        </div>


                        <!-- SECTION 3 -->

                        <div class="reservation-section-title mt-5">

                            <span class="reservation-section-number">
                                3
                            </span>

                            <div>

                                <h5>Statut et canal</h5>

                                <p>
                                    État actuel et origine de la réservation.
                                </p>

                            </div>

                        </div>


                        <div class="row g-4">


                            <!-- STATUT -->

                            <div class="col-md-6">

                                <label
                                    for="statut"
                                    class="reservation-form-label">
                                    Statut
                                </label>

                                <select
                                    name="statut"
                                    id="statut"
                                    class="form-select reservation-input"
                                    required>

                                    <option
                                        value="En_attente"
                                        @if($reservation->statut == "En_attente")
                                            selected
                                        @endif>
                                        En attente
                                    </option>

                                    <option
                                        value="Confirmee"
                                        @if($reservation->statut == "Confirmee")
                                            selected
                                        @endif>
                                        Confirmée
                                    </option>

                                    <option
                                        value="Annulee"
                                        @if($reservation->statut == "Annulee")
                                            selected
                                        @endif>
                                        Annulée
                                    </option>

                                    <option
                                        value="Terminee"
                                        @if($reservation->statut == "Terminee")
                                            selected
                                        @endif>
                                        Terminée
                                    </option>

                                </select>

                            </div>


                            <!-- CANAL -->

                            <div class="col-md-6">

                                <label
                                    for="canal_reservation"
                                    class="reservation-form-label">
                                    Canal de réservation
                                </label>

                                <select
                                    name="canal_reservation"
                                    id="canal_reservation"
                                    class="form-select reservation-input"
                                    required>

                                    <option
                                        value="Site_web"
                                        @if($reservation->canal_reservation == "Site_web")
                                            selected
                                        @endif>
                                        Site web
                                    </option>

                                    <option
                                        value="Telephone"
                                        @if($reservation->canal_reservation == "Telephone")
                                            selected
                                        @endif>
                                        Téléphone
                                    </option>

                                    <option
                                        value="Physique"
                                        @if($reservation->canal_reservation == "Physique")
                                            selected
                                        @endif>
                                        Physique
                                    </option>

                                    <option
                                        value="Email"
                                        @if($reservation->canal_reservation == "Email")
                                            selected
                                        @endif>
                                        Email
                                    </option>

                                    <option
                                        value="Application_mobile"
                                        @if($reservation->canal_reservation == "Application_mobile")
                                            selected
                                        @endif>
                                        Application mobile
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- INFORMATION -->

                        <div class="reservation-resource-notice">

                            <div class="reservation-resource-notice-icon">
                                ✓
                            </div>

                            <div>

                                <strong>
                                    Gestion automatique de la ressource
                                </strong>

                                <p>
                                    Les ressources associées à la réservation
                                    sont gérées automatiquement selon les
                                    disponibilités et les prestations.
                                </p>

                            </div>

                        </div>


                        <!-- ACTIONS -->

                        <div class="reservation-form-actions">

                            <a
                                href="{{ route('reservations.index') }}"
                                class="btn btn-reservation-cancel">
                                Annuler
                            </a>

                            <button
                                type="submit"
                                class="btn btn-vlife btn-save-reservation">
                                ✓ Enregistrer les modifications
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection