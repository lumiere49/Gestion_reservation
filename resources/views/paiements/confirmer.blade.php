@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                Confirmer le paiement
            </h1>

            <p class="text-muted mb-0">
                Vérification et confirmation du paiement de la réservation.
            </p>

        </div>

        <a href="{{ route('paiements.index') }}"
           class="btn btn-paiement-back">

            ← Retour aux paiements

        </a>

    </div>


    <!-- CONTENU -->

    <div class="row justify-content-center">

        <div class="col-lg-8 col-xl-7">

            <div class="card border-0 shadow-sm paiement-confirmation-card">


                <!-- EN-TÊTE -->

                <div class="paiement-confirmation-header">

                    <div class="paiement-confirmation-icon">
                        ₣
                    </div>

                    <div>

                        <span class="paiement-confirmation-label">
                            CONFIRMATION DE PAIEMENT
                        </span>

                        <h2>
                            Réservation #{{ $paiement->idReservation }}
                        </h2>

                        <p class="mb-0">
                            Vérifiez les informations avant de confirmer.
                        </p>

                    </div>

                </div>


                <!-- INFORMATIONS -->

                <div class="card-body p-4 p-lg-5">


                    <div class="paiement-confirmation-summary">

                        <!-- RÉSERVATION -->

                        <div class="paiement-summary-item">

                            <span>
                                Réservation
                            </span>

                            <strong>
                                #{{ $paiement->idReservation }}
                            </strong>

                        </div>


                        <!-- MONTANT -->

                        <div class="paiement-summary-item">

                            <span>
                                Montant à payer
                            </span>

                            <strong class="paiement-summary-amount">

                                {{ number_format($paiement->montant, 0, ',', ' ') }}

                                FCFA

                            </strong>

                        </div>


                        <!-- STATUT -->

                        <div class="paiement-summary-item">

                            <span>
                                Statut actuel
                            </span>

                            <span class="paiement-status paiement-status-pending">
                                En attente
                            </span>

                        </div>

                    </div>


                    <hr class="paiement-confirmation-divider">


                    <!-- FORMULAIRE -->

                    <div class="paiement-confirmation-section">

                        <div class="paiement-section-title">

                            <span class="paiement-section-number">
                                1
                            </span>

                            <div>

                                <h5>
                                    Informations du paiement
                                </h5>

                                <p>
                                    Sélectionnez le mode de paiement et renseignez sa référence.
                                </p>

                            </div>

                        </div>


                        <form action="{{ route('paiements.confirmer', $paiement->idPaiement) }}" method="POST">
    @csrf

    <select name="mode_paiement" required>
        <option value="">-- Choisir le mode de paiement --</option>
        <option value="Especes">Espèces</option>
        <option value="Orange_Money">Orange Money</option>
        <option value="MTN MoMo">MTN Mobile Money</option>
    </select>

    <input
        type="text"
        name="reference_paiement"
        placeholder="Ex : OM-20260813-001"
    >

    <button type="submit">
        Confirmer le paiement
    </button>
</form>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection