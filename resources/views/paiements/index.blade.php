@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- EN-TÊTE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">Paiements VLIFE</h1>

            <p class="text-muted mb-0">
                Gestion et suivi des paiements liés aux réservations.
            </p>
        </div>

        <a href="{{ route('paiements.create') }}"
           class="btn btn-vlife">
            + Ajouter un paiement
        </a>

    </div>


    <!-- TABLEAU -->

    <div class="card border-0 shadow-sm paiement-table-card">

        <div class="card-header paiement-table-header">

            <div>
                <h5 class="mb-1 fw-bold">
                    Liste des paiements
                </h5>

                <span>
                    Paiements enregistrés dans le portail VLIFE
                </span>
            </div>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Réservation</th>

                            <th>Montant</th>

                            <th>Mode</th>

                            <th>Date</th>

                            <th>Statut</th>

                            <th>Référence</th>

                            <th class="text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($paiements as $paiement)

                        <tr>

                            <!-- ID -->

                            <td>

                                <span class="paiement-id">
                                    #{{ $paiement->idPaiement }}
                                </span>

                            </td>


                            <!-- RÉSERVATION -->

                            <td>

                                <div class="paiement-reservation">

                                    <div class="paiement-reservation-icon">
                                        R
                                    </div>

                                    <div>

                                        <strong>
                                            Réservation
                                            #{{ $paiement->reservation->idReservation }}
                                        </strong>

                                        <span>
                                            Paiement associé
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <!-- MONTANT -->

                            <td>

                                <span class="paiement-montant">

                                    {{ number_format($paiement->montant, 0, ',', ' ') }}

                                    FCFA

                                </span>

                            </td>


                            <!-- MODE -->

                            <td>

                                @if($paiement->mode_paiement)

                                    <span class="paiement-mode">

                                        {{ str_replace('_', ' ', $paiement->mode_paiement) }}

                                    </span>

                                @else

                                    <span class="paiement-empty">
                                        —
                                    </span>

                                @endif

                            </td>


                            <!-- DATE -->

                            <td>

                                <span class="paiement-date">

                                    @if($paiement->date_paiement)

                                        {{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}

                                    @else

                                        —

                                    @endif

                                </span>

                            </td>


                            <!-- STATUT -->

                            <td>

                                @if($paiement->statut === 'En_attente')

                                    <span class="paiement-status paiement-status-pending">
                                        En attente
                                    </span>

                                @elseif($paiement->statut === 'payer')

                                    <span class="paiement-status paiement-status-paid">
                                        Payé
                                    </span>

                                @elseif($paiement->statut === 'echouer')

                                    <span class="paiement-status paiement-status-failed">
                                        Échoué
                                    </span>

                                @else

                                    <span class="paiement-status paiement-status-default">
                                        {{ $paiement->statut }}
                                    </span>

                                @endif

                            </td>


                            <!-- RÉFÉRENCE -->

                            <td>

                                @if($paiement->reference_paiement)

                                    <span class="paiement-reference">
                                        {{ $paiement->reference_paiement }}
                                    </span>

                                @else

                                    <span class="paiement-empty">
                                        Non renseignée
                                    </span>

                                @endif

                            </td>


                            <!-- ACTIONS -->

                            <td>

                                <div class="paiement-actions">

    @if(auth()->user()->role !== 'Employe')

        @if($paiement->statut === 'En_attente')

            <form
                action="{{ route('paiements.payer', $paiement->idPaiement) }}"
                method="POST"
                class="m-0">

                @csrf

                <button
                    type="submit"
                    class="btn btn-paiement-pay btn-sm">
                    Payer
                </button>

            </form>

        @endif

        @if(auth()->user()->role === 'Administrateur' || auth()->user()->role === 'Responsable')

    <a
        href="{{ route('paiements.edit', $paiement->idPaiement) }}"
        class="btn btn-paiement-edit btn-sm">
        Modifier
    </a>

@endif

        <form
            action="{{ route('paiements.payer', $paiement->idReservation) }}"
            method="POST"
            class="m-0"
            onsubmit="return confirm('Voulez-vous vraiment supprimer ce paiement ?');">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-paiement-delete btn-sm">
                Supprimer
            </button>

        </form>

    @endif

</div>
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8">

                                <div class="paiement-empty-state">

                                    <div class="paiement-empty-icon">
                                        ₣
                                    </div>

                                    <h5>
                                        Aucun paiement enregistré
                                    </h5>

                                    <p>
                                        Aucun paiement n'est actuellement
                                        enregistré dans le portail VLIFE.
                                    </p>

                                    <a
                                        href="{{ route('paiements.create') }}"
                                        class="btn btn-vlife">
                                        + Ajouter un paiement
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection