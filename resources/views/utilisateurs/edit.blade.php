```blade
@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Modifier un utilisateur</h2>
            <p class="text-muted mb-0">
                Modifier les informations de {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
            </p>
        </div>

        <a href="{{ route('utilisateurs.index') }}" class="btn btn-secondary">
            ← Retour
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur :</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('utilisateurs.update', $utilisateur->idUtilisateur) }}">

                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- NOM --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nom</label>
                        <input type="text"
                               name="nom"
                               class="form-control"
                               value="{{ old('nom', $utilisateur->nom) }}"
                               required>
                    </div>

                    {{-- PRENOM --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Prénom</label>
                        <input type="text"
                               name="prenom"
                               class="form-control"
                               value="{{ old('prenom', $utilisateur->prenom) }}"
                               required>
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $utilisateur->email) }}"
                               required>
                    </div>

                    {{-- TELEPHONE --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Téléphone</label>
                        <input type="text"
                               name="telephone"
                               class="form-control"
                               value="{{ old('telephone', $utilisateur->telephone) }}">
                    </div>

                    {{-- ADRESSE --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Adresse</label>
                        <input type="text"
                               name="adresse"
                               class="form-control"
                               value="{{ old('adresse', $utilisateur->adresse) }}">
                    </div>

                    {{-- ROLE --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Rôle</label>

                        <select name="role"
                                id="role"
                                class="form-select"
                                required>

                            <option value="Administrateur"
                                {{ old('role', $utilisateur->role) == 'Administrateur' ? 'selected' : '' }}>
                                Administrateur
                            </option>

                            <option value="Responsable"
                                {{ old('role', $utilisateur->role) == 'Responsable' ? 'selected' : '' }}>
                                Responsable
                            </option>

                            <option value="Employe"
                                {{ old('role', $utilisateur->role) == 'Employe' ? 'selected' : '' }}>
                                Employé
                            </option>

                        </select>
                    </div>

                    {{-- SERVICE --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Service</label>

                        <select name="idService"
                                id="idService"
                                class="form-select">

                            <option value="">-- Sélectionner un service --</option>

                            @foreach ($services as $service)

                                <option value="{{ $service->idService }}"
                                    {{ old('idService', $utilisateur->idService) == $service->idService ? 'selected' : '' }}>
                                    {{ $service->nom }}
                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">
                            Obligatoire pour un Responsable ou un Employé.
                        </small>
                    </div>

                    {{-- MOT DE PASSE --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Nouveau mot de passe
                        </label>

                        <input type="password"
                               name="mot_de_passe"
                               class="form-control">

                        <small class="text-muted">
                            Laisser vide pour conserver le mot de passe actuel.
                        </small>
                    </div>

                    {{-- CONFIRMATION --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Confirmer le nouveau mot de passe
                        </label>

                        <input type="password"
                               name="mot_de_passe_confirmation"
                               class="form-control">
                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('utilisateurs.index') }}"
                       class="btn btn-secondary">
                        Annuler
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        Enregistrer les modifications
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const role = document.getElementById('role');
    const service = document.getElementById('idService');

    function verifierService() {

        if (role.value === 'Administrateur') {
            service.value = '';
            service.disabled = true;
        } else {
            service.disabled = false;
        }
    }

    role.addEventListener('change', verifierService);

    verifierService();
});
</script>

@endsection
```
