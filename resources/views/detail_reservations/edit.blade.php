@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <h1 class="page-title">Modifier un détail de réservation</h1>

        <p class="page-subtitle">
            Modifier la prestation associée à une réservation
        </p>
    </div>

    <a href="{{ url('/detail-reservations') }}" class="btn-secondary">
        ← Retour
    </a>

</div>


<div class="form-card">

    <form
        action="{{ route(
            'detail-reservations.update',
            ['detail_reservation' => $detail->idDetail]
        ) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        {{-- RÉSERVATION --}}
        <div class="form-group">

            <label for="idReservation">
                Réservation
            </label>

            <select
                name="idReservation"
                id="idReservation"
                required
            >

                <option value="">
                    -- Sélectionner une réservation --
                </option>

                @foreach($reservations as $reservation)

                    <option
                        value="{{ $reservation->idReservation }}"
                        {{ $reservation->idReservation == $detail->idReservation ? 'selected' : '' }}
                    >
                        Réservation #{{ $reservation->idReservation }}
                    </option>

                @endforeach

            </select>

            @error('idReservation')
                <small class="error-message">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- PRESTATION --}}
        <div class="form-group">

            <label for="idPrestation">
                Prestation
            </label>

            <select
                name="idPrestation"
                id="idPrestation"
                required
            >

                <option value="">
                    -- Sélectionner une prestation --
                </option>

                @foreach($prestations as $prestation)

                    <option
                        value="{{ $prestation->idPrestation }}"
                        {{ $prestation->idPrestation == $detail->idPrestation ? 'selected' : '' }}
                    >
                        {{ $prestation->nom }}
                    </option>

                @endforeach

            </select>

            @error('idPrestation')
                <small class="error-message">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- QUANTITÉ --}}
        <div class="form-group">

            <label for="quantite">
                Quantité
            </label>

            <input
                type="number"
                name="quantite"
                id="quantite"
                value="{{ old('quantite', $detail->quantite) }}"
                min="1"
                required
            >

            @error('quantite')
                <small class="error-message">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- PRIX --}}
        <div class="form-group">

            <label for="prix">
                Prix
            </label>

            <div class="input-with-suffix">

                <input
                    type="number"
                    name="prix"
                    id="prix"
                    value="{{ old('prix', $detail->prix) }}"
                    min="0"
                    step="0.01"
                    required
                >

                <span>FCFA</span>

            </div>

            @error('prix')
                <small class="error-message">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- BOUTONS --}}
        <div class="form-actions">

            <a href="{{ url('/detail-reservations') }}"
               class="btn-cancel">
                Annuler
            </a>

            <button type="submit"
                    class="btn-vlife">
                Enregistrer les modifications
            </button>

        </div>

    </form>

</div>


<style>

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.page-title {
    margin: 0;
    color: var(--vlife-anthracite);
    font-size: 28px;
    font-weight: 700;
}

.page-subtitle {
    margin: 6px 0 0;
    color: var(--vlife-gray);
    font-size: 14px;
}

.form-card {
    max-width: 850px;
    background: white;
    border: 1px solid var(--vlife-border);
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.form-group {
    margin-bottom: 22px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: var(--vlife-anthracite);
    font-size: 14px;
    font-weight: 600;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 11px 13px;
    border: 1px solid var(--vlife-border);
    border-radius: 7px;
    background: white;
    color: var(--vlife-anthracite);
    font-size: 14px;
    outline: none;
    transition: 0.2s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: var(--vlife-bordeaux);
    box-shadow: 0 0 0 3px rgba(139, 0, 56, 0.08);
}

.input-with-suffix {
    position: relative;
}

.input-with-suffix input {
    padding-right: 70px;
}

.input-with-suffix span {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--vlife-gray);
    font-size: 13px;
    font-weight: 600;
}

.error-message {
    display: block;
    margin-top: 6px;
    color: #b0003a;
    font-size: 12px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--vlife-border);
}

.btn-vlife,
.btn-secondary,
.btn-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 11px 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease;
}

.btn-vlife {
    background: var(--vlife-gradient);
    color: white;
    border: none;
}

.btn-vlife:hover {
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(139, 0, 56, 0.20);
}

.btn-secondary,
.btn-cancel {
    background: #f3f4f6;
    color: var(--vlife-anthracite);
    border: 1px solid var(--vlife-border);
}

.btn-secondary:hover,
.btn-cancel:hover {
    background: #e5e7eb;
    color: var(--vlife-anthracite);
}

@media (max-width: 768px) {

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .form-card {
        padding: 20px;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions a,
    .form-actions button {
        width: 100%;
    }

}

</style>

@endsection