@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Nouvelle réservation</h1>

            <p class="text-muted mb-0">
                Créer une réservation dans le portail unifié VLIFE.
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

                <!-- EN-TÊTE DU FORMULAIRE -->
                <div class="reservation-form-header">

                    <div class="reservation-form-icon">
                        VL
                    </div>

                    <div>
                        <h4 class="mb-1">
                            Nouvelle réservation
                        </h4>

                        <p class="mb-0">
                            Renseignez les informations nécessaires à la réservation.
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


                    <form action="{{ route('reservations.store') }}"
                          method="POST">

                        @csrf


                        <!-- INFORMATIONS PRINCIPALES -->

                        <div class="reservation-section-title">

                            <span class="reservation-section-number">
                                1
                            </span>

                            <div>
                                <h5>Informations de réservation</h5>
                                <p>
                                    Sélectionnez le client, le service et la prestation.
                                </p>
                            </div>

                        </div>


                        <div class="row g-4">


                            <!-- CLIENT -->

                            <div class="col-md-6">

                                <label for="idClient"
                                       class="reservation-form-label">
                                    Client
                                </label>

                                <select name="idClient"
                                        id="idClient"
                                        class="form-select reservation-input"
                                        required>

                                    <option value="">
                                        -- Choisir un client --
                                    </option>

                                    @foreach($clients as $client)

                                        <option value="{{ $client->idClient }}"
                                            {{ old('idClient') == $client->idClient ? 'selected' : '' }}>

                                            {{ $client->nom }}
                                            {{ $client->prenom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <!-- SERVICE -->

                            <div class="col-md-6">

                                <label for="service"
                                       class="reservation-form-label">
                                    Service
                                </label>

                                <select name="idService"
                                        id="service"
                                        class="form-select reservation-input"
                                        required>

                                    <option value="">
                                        -- Choisir un service --
                                    </option>

                                    @foreach($services as $service)

                                        <option value="{{ $service->idService }}"
                                            {{ old('idService') == $service->idService ? 'selected' : '' }}>

                                            {{ $service->nom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <!-- PRESTATION -->

                            <div class="col-12">

                                <label for="prestation"
                                       class="reservation-form-label">
                                    Prestation
                                </label>

                                <select name="idPrestation"
                                        id="prestation"
                                        class="form-select reservation-input"
                                        required>

                                    <option value="">
                                        -- Choisir d'abord un service --
                                    </option>

                                </select>

                                <small class="reservation-help">
                                    Les prestations disponibles seront chargées automatiquement
                                    selon le service sélectionné.
                                </small>

                            </div>

                        </div>

                        <!-- NOMBRE DE PERSONNES -->
<div class="row g-4 mt-1">
    <div class="col-md-6">
        <label for="nombre_personnes" class="reservation-form-label">
            Nombre de personnes
        </label>

        <input
            type="number"
            id="nombre_personnes"
            name="nombre_personnes"
            value="{{ old('nombre_personnes', 1) }}"
            min="1"
            class="form-control reservation-input"
            required
        >

        <small class="reservation-help">
            Indiquez le nombre de personnes concernées par la réservation.
        </small>
    </div>
</div>


                        <!-- PLANIFICATION -->

                        <div class="reservation-section-title mt-5">

                            <span class="reservation-section-number">
                                2
                            </span>

                            <div>
                                <h5>Planification</h5>
                                <p>
                                    Définissez la date et l'horaire de la réservation.
                                </p>
                            </div>

                        </div>


                        <div class="row g-4">


                            <!-- DATE -->

                            <div class="col-md-4">

                                <label for="date_reservation"
                                       class="reservation-form-label">
                                    Date
                                </label>

                                <input
                                    type="date"
                                    id="date_reservation"
                                    name="date_reservation"
                                    value="{{ old('date_reservation') }}"
                                    class="form-control reservation-input"
                                    required
                                >

                            </div>


                            <!-- HEURE DEBUT -->

                            <div class="col-md-4">

                                <label for="heure_debut"
                                       class="reservation-form-label">
                                    Heure de début
                                </label>

                                <input
                                    type="time"
                                    id="heure_debut"
                                    name="heure_debut"
                                    value="{{ old('heure_debut') }}"
                                    class="form-control reservation-input"
                                    required
                                >

                            </div>


                            <!-- HEURE FIN -->

                            <div class="col-md-4">

                                <label for="heure_fin"
                                       class="reservation-form-label">
                                    Heure de fin
                                </label>

                                <input
                                    type="time"
                                    id="heure_fin"
                                    name="heure_fin"
                                    value="{{ old('heure_fin') }}"
                                    class="form-control reservation-input"
                                    required
                                >

                            </div>

                        </div>


                        <!-- STATUT ET CANAL -->

                        <div class="reservation-section-title mt-5">

                            <span class="reservation-section-number">
                                3
                            </span>

                            <div>
                                <h5>Statut et canal</h5>
                                <p>
                                    Précisez l'état et l'origine de la réservation.
                                </p>
                            </div>

                        </div>


                        <div class="row g-4">


                            <!-- STATUT -->

                            <div class="col-md-6">

                                <label for="statut"
                                       class="reservation-form-label">
                                    Statut
                                </label>

                                <select name="statut"
                                        id="statut"
                                        class="form-select reservation-input"
                                        required>

                                    <option value="En_attente"
                                        {{ old('statut', 'En_attente') == 'En_attente' ? 'selected' : '' }}>
                                        En attente
                                    </option>

                                    <option value="Confirmee"
                                        {{ old('statut') == 'Confirmee' ? 'selected' : '' }}>
                                        Confirmée
                                    </option>

                                    <option value="Annulee"
                                        {{ old('statut') == 'Annulee' ? 'selected' : '' }}>
                                        Annulée
                                    </option>

                                    <option value="Terminee"
                                        {{ old('statut') == 'Terminee' ? 'selected' : '' }}>
                                        Terminée
                                    </option>

                                </select>

                            </div>


                            <!-- CANAL -->

                            <div class="col-md-6">

                                <label for="canal_reservation"
                                       class="reservation-form-label">
                                    Canal de réservation
                                </label>

                                <select name="canal_reservation"
                                        id="canal_reservation"
                                        class="form-select reservation-input"
                                        required>

                                    <option value="Site_web"
                                        {{ old('canal_reservation', 'Site_web') == 'Site_web' ? 'selected' : '' }}>
                                        Site web
                                    </option>

                                    <option value="Telephone"
                                        {{ old('canal_reservation') == 'Telephone' ? 'selected' : '' }}>
                                        Téléphone
                                    </option>

                                    <option value="Physique"
                                        {{ old('canal_reservation') == 'Physique' ? 'selected' : '' }}>
                                        Physique
                                    </option>

                                    <option value="Email"
                                        {{ old('canal_reservation') == 'Email' ? 'selected' : '' }}>
                                        Email
                                    </option>

                                    <option value="Application_mobile"
                                        {{ old('canal_reservation') == 'Application_mobile' ? 'selected' : '' }}>
                                        Application mobile
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- INFORMATION AFFECTATION -->

                        <div class="reservation-resource-notice">

                            <div class="reservation-resource-notice-icon">
                                ✓
                            </div>

                            <div>

                                <strong>
                                    Affectation automatique de la ressource
                                </strong>

                                <p>
                                    La ressource sera automatiquement affectée
                                    selon la prestation sélectionnée et les
                                    disponibilités.
                                </p>

                            </div>

                        </div>


                        <!-- ACTIONS -->

                        <div class="reservation-form-actions">

                            <a href="{{ route('reservations.index') }}"
                               class="btn btn-reservation-cancel">
                                Annuler
                            </a>

                            <button type="submit"
                                    class="btn btn-vlife btn-save-reservation">
                                ✓ Enregistrer la réservation
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     CHARGEMENT DYNAMIQUE DES PRESTATIONS
     NE PAS MODIFIER LA LOGIQUE
     ===================================================== -->

<script>

document.getElementById('service').addEventListener('change', function () {

    let serviceId = this.value;

    let prestationSelect =
        document.getElementById('prestation');


    /*
    |--------------------------------------------------------------------------
    | Aucun service sélectionné
    |--------------------------------------------------------------------------
    */

    if (serviceId === '') {

        prestationSelect.innerHTML =
            '<option value="">-- Choisir d\'abord un service --</option>';

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Affichage du chargement
    |--------------------------------------------------------------------------
    */

    prestationSelect.innerHTML =
        '<option value="">Chargement...</option>';


    /*
    |--------------------------------------------------------------------------
    | Chargement des prestations
    |--------------------------------------------------------------------------
    */

    fetch('/services/' + serviceId + '/prestations')

        .then(function (response) {

            if (!response.ok) {

                throw new Error(
                    'Erreur HTTP : ' + response.status
                );

            }

            return response.json();

        })

        .then(function (data) {

            prestationSelect.innerHTML =
                '<option value="">-- Choisir une prestation --</option>';


            /*
            | Si aucune prestation
            */

            if (data.length === 0) {

                prestationSelect.innerHTML =
                    '<option value="">Aucune prestation disponible</option>';

                return;
            }


            /*
            | Ajout des prestations
            */

            data.forEach(function (prestation) {

    let option =
        document.createElement('option');

    option.value =
        prestation.idPrestation;

    // ========================================================
    // AFFICHAGE DES TARIFS VLOUNGE
    // ========================================================

    let nom = (prestation.nom || '').toLowerCase();

    let prixAffiche = prestation.prix;
    let indication = '';

    // Option 1 : 3 000 FCFA par personne
    if (nom.includes('option 1')) {

        prixAffiche = 3000;
        indication = ' / personne';
    }

    // Option 2 : 50 000 FCFA prix fixe
    else if (nom.includes('option 2')) {

        prixAffiche = 50000;
        indication = ' (prix fixe)';
    }

    // Option 3 : 5 000 FCFA par personne
    else if (nom.includes('option 3')) {

        prixAffiche = 5000;
        indication = ' / personne';
    }

    // Salle de Lounge : 400 000 FCFA prix fixe
    else if (nom.includes('salle de lounge')) {

        prixAffiche = 400000;
        indication = ' (prix fixe)';
    }

    option.textContent =
        prestation.nom +
        ' - ' +
        prixAffiche +
        ' FCFA' +
        indication;

    prestationSelect.appendChild(option);

});

        })

        .catch(function (error) {

            console.error(
                'Erreur lors du chargement des prestations :',
                error
            );

            prestationSelect.innerHTML =
                '<option value="">Erreur de chargement</option>';

        });

});

</script>

@endsection