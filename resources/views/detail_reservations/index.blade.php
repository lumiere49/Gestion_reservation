@extends('layouts.app')

@section('content')

<div class="detail-page">

    {{-- EN-TÊTE --}}
    <div class="detail-page-header">

        <div>
            <h1 class="detail-page-title">
                Détails des réservations
            </h1>

            <p class="detail-page-subtitle">
                Gestion des prestations associées aux réservations
            </p>
        </div>

        <a href="{{ route('detail-reservations.create') }}"
           class="detail-btn-primary">
            <span class="detail-btn-icon">+</span>
            Ajouter un détail
        </a>

    </div>


    {{-- CARTE PRINCIPALE --}}
    <div class="detail-card">

        {{-- EN-TÊTE DE LA CARTE --}}
        <div class="detail-card-header">

            <div>
                <h2>
                    Liste des détails
                </h2>

                <p>
                    Prestations et informations associées aux réservations VLIFE
                </p>
            </div>

            <div class="detail-count">

                <span class="detail-count-number">
                    {{ $details->count() }}
                </span>

                <span class="detail-count-label">
                    détail(s)
                </span>

            </div>

        </div>


        {{-- TABLEAU --}}
        <div class="table-responsive">

            <table class="detail-table">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Réservation</th>

                        <th>Prestation</th>

                        <th class="text-center">
                            Quantité
                        </th>

                        <th>
                            Prix
                        </th>

                        <th class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($details as $detail)

                    <tr>

                        {{-- ID --}}
                        <td>

                            <span class="detail-id">
                                #{{ $detail->idDetail }}
                            </span>

                        </td>


                        {{-- RÉSERVATION --}}
                        <td>

                            <div class="detail-reservation">

                                <div class="detail-reservation-icon">
                                    R
                                </div>

                                <div>

                                    <strong>
                                        Réservation #{{ $detail->reservation->idReservation }}
                                    </strong>

                                    <span>
                                        Réservation VLIFE
                                    </span>

                                </div>

                            </div>

                        </td>


                        {{-- PRESTATION --}}
                        <td>

                            <div class="detail-prestation">

                                <div class="detail-prestation-icon">
                                    P
                                </div>

                                <span>
                                    {{ $detail->prestation->nom ?? 'Prestation non renseignée' }}
                                </span>

                            </div>

                        </td>


                        {{-- QUANTITÉ --}}
                        <td class="text-center">

                            <span class="detail-quantity">
                                {{ $detail->quantite }}
                            </span>

                        </td>


                        {{-- PRIX --}}
                        <td>

                            <span class="detail-price">

                                {{ number_format($detail->prix, 0, ',', ' ') }}

                                <small>FCFA</small>

                            </span>

                        </td>


                        {{-- ACTIONS --}}
                        <td>

                            <div class="detail-actions">

                                <a href="{{ route(
                                    'detail-reservations.edit',
                                    ['detail_reservation' => $detail->idDetail]
                                ) }}"
                                   class="detail-action detail-action-edit">

                                    Modifier

                                </a>


                                <form
                                    action="{{ route(
                                        'detail-reservations.destroy',
                                        ['detail_reservation' => $detail->idDetail]
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce détail ?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="detail-action detail-action-delete">

                                        Supprimer

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6">

                            <div class="detail-empty">

                                <div class="detail-empty-icon">
                                    📋
                                </div>

                                <h3>
                                    Aucun détail enregistré
                                </h3>

                                <p>
                                    Aucun détail de réservation n'est actuellement enregistré.
                                </p>

                                <a href="{{ route('detail-reservations.create') }}"
                                   class="detail-btn-primary">

                                    + Ajouter un détail

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


<style>

/* =========================================================
   PAGE DÉTAILS DES RÉSERVATIONS
   ========================================================= */

.detail-page {
    width: 100%;
}


/* =========================================================
   EN-TÊTE
   ========================================================= */

.detail-page-header {

    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 25px;

}

.detail-page-title {

    margin: 0;

    color: var(--vlife-anthracite);

    font-size: 28px;
    font-weight: 700;

}

.detail-page-subtitle {

    margin: 6px 0 0;

    color: var(--vlife-gray);

    font-size: 14px;

}


/* =========================================================
   BOUTON PRINCIPAL
   ========================================================= */

.detail-btn-primary {

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    padding: 11px 18px;

    background: var(--vlife-gradient);

    color: #ffffff;

    text-decoration: none;

    border-radius: 8px;

    font-size: 14px;
    font-weight: 600;

    border: none;

    cursor: pointer;

    transition: all 0.2s ease;

}

.detail-btn-primary:hover {

    color: #ffffff;

    transform: translateY(-1px);

    box-shadow:
        0 5px 12px rgba(139, 0, 56, 0.20);

}

.detail-btn-icon {

    font-size: 18px;

    line-height: 1;

}


/* =========================================================
   CARTE
   ========================================================= */

.detail-card {

    background: var(--vlife-white);

    border: 1px solid var(--vlife-border);

    border-radius: 12px;

    box-shadow:
        0 2px 8px rgba(0, 0, 0, 0.04);

    overflow: hidden;

}


/* =========================================================
   EN-TÊTE CARTE
   ========================================================= */

.detail-card-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 20px 22px;

    border-bottom: 1px solid var(--vlife-border);

    background: #ffffff;

}

.detail-card-header h2 {

    margin: 0 0 4px;

    color: var(--vlife-anthracite);

    font-size: 17px;

    font-weight: 700;

}

.detail-card-header p {

    margin: 0;

    color: var(--vlife-gray);

    font-size: 13px;

}


/* =========================================================
   COMPTEUR
   ========================================================= */

.detail-count {

    display: flex;

    align-items: center;

    gap: 7px;

    padding: 7px 12px;

    background: #f3e8ee;

    border-radius: 7px;

}

.detail-count-number {

    color: var(--vlife-bordeaux);

    font-size: 15px;

    font-weight: 700;

}

.detail-count-label {

    color: var(--vlife-gray);

    font-size: 12px;

}


/* =========================================================
   TABLEAU
   ========================================================= */

.table-responsive {

    width: 100%;

    overflow-x: auto;

}

.detail-table {

    width: 100%;

    border-collapse: collapse;

}

.detail-table thead {

    background: #f8f8f9;

}

.detail-table th {

    padding: 14px 18px;

    text-align: left;

    color: var(--vlife-anthracite);

    font-size: 12px;

    font-weight: 700;

    border-bottom: 1px solid var(--vlife-border);

    white-space: nowrap;

}

.detail-table td {

    padding: 15px 18px;

    color: #444444;

    font-size: 14px;

    border-bottom: 1px solid #eeeeee;

    vertical-align: middle;

}

.detail-table tbody tr {

    transition: background 0.15s ease;

}

.detail-table tbody tr:hover {

    background: #fafafa;

}

.detail-table tbody tr:last-child td {

    border-bottom: none;

}


/* =========================================================
   ID
   ========================================================= */

.detail-id {

    display: inline-flex;

    align-items: center;

    padding: 5px 9px;

    border-radius: 6px;

    background: #f3e8ee;

    color: var(--vlife-bordeaux);

    font-size: 12px;

    font-weight: 700;

}


/* =========================================================
   RÉSERVATION
   ========================================================= */

.detail-reservation {

    display: flex;

    align-items: center;

    gap: 10px;

}

.detail-reservation-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    flex-shrink: 0;

    border-radius: 8px;

    background: var(--vlife-gradient);

    color: #ffffff;

    font-size: 12px;

    font-weight: 700;

}

.detail-reservation strong {

    display: block;

    color: var(--vlife-anthracite);

    font-size: 13px;

}

.detail-reservation span {

    display: block;

    margin-top: 2px;

    color: var(--vlife-gray);

    font-size: 11px;

}


/* =========================================================
   PRESTATION
   ========================================================= */

.detail-prestation {

    display: flex;

    align-items: center;

    gap: 9px;

}

.detail-prestation-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 30px;
    height: 30px;

    border-radius: 7px;

    background: #f3e8ee;

    color: var(--vlife-bordeaux);

    font-size: 11px;

    font-weight: 700;

}

.detail-prestation span {

    color: var(--vlife-bordeaux);

    font-weight: 600;

}


/* =========================================================
   QUANTITÉ
   ========================================================= */

.detail-quantity {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 30px;

    padding: 5px 8px;

    background: #f3f4f6;

    border-radius: 6px;

    color: var(--vlife-anthracite);

    font-size: 12px;

    font-weight: 700;

}


/* =========================================================
   PRIX
   ========================================================= */

.detail-price {

    color: var(--vlife-anthracite);

    font-weight: 700;

    white-space: nowrap;

}

.detail-price small {

    color: var(--vlife-gray);

    font-size: 10px;

    font-weight: 600;

}


/* =========================================================
   ACTIONS
   ========================================================= */

.detail-actions {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

}

.detail-actions form {

    margin: 0;

}

.detail-action {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 7px 11px;

    border-radius: 6px;

    font-size: 12px;

    font-weight: 600;

    text-decoration: none;

    border: none;

    cursor: pointer;

    transition: all 0.2s ease;

}

.detail-action-edit {

    background: #f3f4f6;

    color: var(--vlife-anthracite);

}

.detail-action-edit:hover {

    background: var(--vlife-anthracite);

    color: #ffffff;

}

.detail-action-delete {

    background: #fbe9ee;

    color: #a00035;

}

.detail-action-delete:hover {

    background: #a00035;

    color: #ffffff;

}


/* =========================================================
   ÉTAT VIDE
   ========================================================= */

.detail-empty {

    text-align: center;

    padding: 55px 20px;

}

.detail-empty-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 58px;
    height: 58px;

    margin: 0 auto 15px;

    border-radius: 50%;

    background: #f3e8ee;

    font-size: 27px;

}

.detail-empty h3 {

    margin: 0 0 8px;

    color: var(--vlife-anthracite);

    font-size: 18px;

}

.detail-empty p {

    margin: 0 0 20px;

    color: var(--vlife-gray);

    font-size: 14px;

}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 900px) {

    .detail-table {

        min-width: 850px;

    }

}


@media (max-width: 768px) {

    .detail-page-header {

        flex-direction: column;

        align-items: flex-start;

        gap: 15px;

    }

    .detail-page-title {

        font-size: 23px;

    }

    .detail-card-header {

        align-items: flex-start;

        gap: 15px;

    }

    .detail-actions {

        flex-direction: column;

        align-items: stretch;

    }

    .detail-action {

        width: 100%;

    }

}

</style>

@endsection