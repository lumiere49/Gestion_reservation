@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Modifier un paiement</h1>

            <p class="text-muted mb-0">
                Modification du paiement
                <strong>#{{ $paiement->idPaiement }}</strong>.
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
                            Modifier le paiement
                        </h4>

                        <p class="mb-0">
                            Mettez à jour les informations de ce paiement.
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


                    <form
                        action="{{ route('paiements.update', $paiement->idPaiement) }}"
                        method="POST">

                        @csrf
                        @method('PUT')


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
                                    Réservation associée à ce paiement.
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

                                    @foreach($reservations as $reservation)

                                        <option
                                            value="{{ $reservation->idReservation }}"
                                            @if($reservation->idReservation == $paiement->idReservation)
                                                selected
                                            @endif>

                                            Réservation #{{ $reservation->idReservation }}

                                        </option>

                                    @endforeach

                                </select>

                                <small class="paiement-help">
                                    Sélectionnez la réservation liée à ce paiement.
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
                                    Montant, mode et date du paiement.
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
                                        name="montant"
                                        id="montant"
                                        value="{{ $paiement->montant }}"
                                        class="form-control paiement-input"
                                        required>

                                    <span class="paiement-input-unit">
                                        FCFA
                                    </span>

                                </div>

                            </div>


                            <!-- MODE -->

                            <div class="col-md-6">

                                <label
                                    for="modePaiement"
                                    class="paiement-form-label">

                                    Mode de paiement

                                </label>

                                <select
                                    name="modePaiement"
                                    id="modePaiement"
                                    class="form-select paiement-input"
                                    required>

                                    <option
                                        value="Espèces"
                                        @if($paiement->modePaiement == "Espèces")
                                            selected
                                        @endif>
                                        Espèces
                                    </option>

                                    <option
                                        value="Orange Money"
                                        @if($paiement->modePaiement == "Orange Money")
                                            selected
                                        @endif>
                                        Orange Money
                                    </option>

                                    <option
                                        value="MTN Mobile Money"
                                        @if($paiement->modePaiement == "MTN Mobile Money")
                                            selected
                                        @endif>
                                        MTN Mobile Money
                                    </option>

                                    <option
                                        value="Carte bancaire"
                                        @if($paiement->modePaiement == "Carte bancaire")
                                            selected
                                        @endif>
                                        Carte bancaire
                                    </option>

                                </select>

                            </div>


                            <!-- DATE -->

                            <div class="col-md-6">

                                <label
                                    for="datePaiement"
                                    class="paiement-form-label">

                                    Date du paiement

                                </label>

                                <input
                                    type="date"
                                    name="datePaiement"
                                    id="datePaiement"
                                    value="{{ $paiement->datePaiement }}"
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
                                        value="En attente"
                                        @if($paiement->statut == "En attente")
                                            selected
                                        @endif>
                                        En attente
                                    </option>

                                    <option
                                        value="Payé"
                                        @if($paiement->statut == "Payé")
                                            selected
                                        @endif>
                                        Payé
                                    </option>

                                    <option
                                        value="Annulé"
                                        @if($paiement->statut == "Annulé")
                                            selected
                                        @endif>
                                        Annulé
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- INFORMATION -->

                        <div class="paiement-notice">

                            <div class="paiement-notice-icon">
                                ✓
                            </div>

                            <div>

                                <strong>
                                    Modification du paiement
                                </strong>

                                <p>
                                    Vérifiez les informations avant
                                    d'enregistrer les modifications.
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