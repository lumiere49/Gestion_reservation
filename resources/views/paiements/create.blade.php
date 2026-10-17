@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Ajouter un paiement</h1>

            <p class="text-muted mb-0">
                Enregistrer un nouveau paiement associé à une réservation VLIFE.
            </p>
        </div>

        <a href="{{ route('paiements.index') }}"
           class="btn btn-paiement-back">
            ← Retour aux paiements
        </a>

    </div>


    <!-- FORMULAIRE -->

    <div class="row justify-content-center">

        <div class="col-lg-9 col-xl-8">

            <div class="card border-0 shadow-sm paiement-form-card">

                <!-- EN-TÊTE DU FORMULAIRE -->

                <div class="paiement-form-header">

                    <div class="paiement-form-icon">
                        ₣
                    </div>

                    <div>

                        <h4 class="mb-1">
                            Nouveau paiement
                        </h4>

                        <p class="mb-0">
                            Renseignez les informations du paiement.
                        </p>

                    </div>

                </div>


                <div class="card-body p-4 p-lg-5">

                    <!-- ERREURS -->

                    @if ($errors->any())

                        <div class="alert alert-danger shadow-sm">

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


                    <form action="{{ route('paiements.store') }}"
                          method="POST">

                        @csrf


                        <!-- SECTION 1 -->

                        <div class="paiement-section-title">

                            <span class="paiement-section-number">
                                1
                            </span>

                            <div>

                                <h5>
                                    Réservation
                                </h5>

                                <p>
                                    Sélectionnez la réservation concernée par le paiement.
                                </p>

                            </div>

                        </div>


                        <div class="row g-4">

                            <div class="col-12">

                                <label
                                    for="idReservation"
                                    class="paiement-form-label">

                                    Réservation

                                </label>

                                <select
                                    name="idReservation"
                                    id="idReservation"
                                    class="form-select paiement-input"
                                    required>

                                    <option value="">
                                        -- Choisir une réservation --
                                    </option>

                                    @foreach($reservations as $reservation)

                                        <option
                                            value="{{ $reservation->idReservation }}"
                                            {{ old('idReservation') == $reservation->idReservation ? 'selected' : '' }}>

                                            Réservation #{{ $reservation->idReservation }}

                                        </option>

                                    @endforeach

                                </select>

                                <small class="paiement-help">
                                    Le paiement sera automatiquement associé à cette réservation.
                                </small>

                            </div>

                        </div>


                        <!-- SECTION 2 -->

                        <div class="paiement-section-title mt-5">

                            <span class="paiement-section-number">
                                2
                            </span>

                            <div>

                                <h5>
                                    Informations financières
                                </h5>

                                <p>
                                    Indiquez le montant et le mode de paiement utilisé.
                                </p>

                            </div>

                        </div>


                        <div class="row g-4">

                            <!-- MONTANT -->

                            <div class="col-md-6">

                                <label
                                    for="montant"
                                    class="paiement-form-label">

                                    Montant

                                </label>

                                <div class="paiement-input-group">

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        name="montant"
                                        id="montant"
                                        value="{{ old('montant') }}"
                                        class="form-control paiement-input"
                                        placeholder="Ex. 20 000"
                                        required>

                                    <span class="paiement-input-unit">
                                        FCFA
                                    </span>

                                </div>

                            </div>


                            <!-- MODE -->

                            <div class="col-md-6">

                                <label
                                    for="mode_paiement"
                                    class="paiement-form-label">

                                    Mode de paiement

                                </label>

                                <select
                                    name="mode_paiement"
                                    id="mode_paiement"
                                    class="form-select paiement-input"
                                    required>

                                    <option value="">
                                        -- Choisir un mode --
                                    </option>

                                    <option
                                        value="Especes"
                                        {{ old('mode_paiement') == 'Especes' ? 'selected' : '' }}>
                                        Espèces
                                    </option>

                                    <option
                                        value="Orange_Money"
                                        {{ old('mode_paiement') == 'Orange_Money' ? 'selected' : '' }}>
                                        Orange Money
                                    </option>

                                    <option
                                        value="MTN MoMo"
                                        {{ old('mode_paiement') == 'MTN MoMo' ? 'selected' : '' }}>
                                        MTN Mobile Money
                                    </option>

                                </select>

                            </div>


                            <!-- DATE -->

                            <div class="col-md-6">

                                <label
                                    for="date_paiement"
                                    class="paiement-form-label">

                                    Date du paiement

                                </label>

                                <input
                                    type="date"
                                    name="date_paiement"
                                    id="date_paiement"
                                    value="{{ old('date_paiement', date('Y-m-d')) }}"
                                    class="form-control paiement-input"
                                    required>

                            </div>


                            <!-- STATUT -->

                            <div class="col-md-6">

                                <label
                                    for="statut"
                                    class="paiement-form-label">

                                    Statut

                                </label>

                                <select
                                    name="statut"
                                    id="statut"
                                    class="form-select paiement-input"
                                    required>

                                    <option
                                        value="En_attente"
                                        {{ old('statut', 'En_attente') == 'En_attente' ? 'selected' : '' }}>
                                        En attente
                                    </option>

                                    <option
                                        value="payer"
                                        {{ old('statut') == 'payer' ? 'selected' : '' }}>
                                        Payé
                                    </option>

                                    <option
                                        value="echouer"
                                        {{ old('statut') == 'echouer' ? 'selected' : '' }}>
                                        Échoué
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- SECTION 3 -->

                        <div class="paiement-section-title mt-5">

                            <span class="paiement-section-number">
                                3
                            </span>

                            <div>

                                <h5>
                                    Référence
                                </h5>

                                <p>
                                    Ajoutez la référence de la transaction si elle est disponible.
                                </p>

                            </div>

                        </div>


                        <div class="row g-4">

                            <div class="col-12">

                                <label
                                    for="reference_paiement"
                                    class="paiement-form-label">

                                    Référence du paiement

                                </label>

                                <input
                                    type="text"
                                    name="reference_paiement"
                                    id="reference_paiement"
                                    value="{{ old('reference_paiement') }}"
                                    class="form-control paiement-input"
                                    placeholder="Ex : OM-20260815-001">

                                <small class="paiement-help">
                                    Cette référence permet d'identifier la transaction.
                                </small>

                            </div>

                        </div>


                        <!-- INFORMATION -->

                        <div class="paiement-notice">

                            <div class="paiement-notice-icon">
                                ✓
                            </div>

                            <div>

                                <strong>
                                    Enregistrement sécurisé du paiement
                                </strong>

                                <p>
                                    Vérifiez les informations avant de valider
                                    l'enregistrement du paiement.
                                </p>

                            </div>

                        </div>


                        <!-- BOUTONS -->

                        <div class="paiement-form-actions">

                            <a
                                href="{{ route('paiements.index') }}"
                                class="btn btn-paiement-cancel">

                                Annuler

                            </a>

                            <button
                                type="submit"
                                class="btn btn-vlife btn-save-paiement">

                                ✓ Enregistrer le paiement

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection