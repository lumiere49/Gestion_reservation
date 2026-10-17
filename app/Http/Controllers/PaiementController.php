<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
{
    $utilisateur = auth()->user();

    // L'employé ne peut pas gérer les paiements
    if ($utilisateur->role === 'Employe') {
        abort(
            403,
            'Accès refusé. Les employés ne peuvent pas gérer les paiements.'
        );
    }

    $query = Paiement::with('reservation.service');

    // Le Responsable ne voit que les paiements de son service
    if ($utilisateur->role === 'Responsable') {
        $query->whereHas('reservation', function ($q) use ($utilisateur) {
            $q->where('idService', $utilisateur->idService);
        });
    }

    $paiements = $query->get();

    return view('paiements.index', compact('paiements'));
}

    public function create()
{
    $utilisateur = auth()->user();

    // L'employé ne peut pas créer de paiement
    if ($utilisateur->role === 'Employe') {
        abort(
            403,
            'Accès refusé. Les employés ne peuvent pas créer de paiements.'
        );
    }

    if ($utilisateur->role === 'Responsable') {
        $reservations = Reservation::where(
            'idService',
            $utilisateur->idService
        )->get();
    } else {
        $reservations = Reservation::all();
    }

    return view(
        'paiements.create',
        compact('reservations')
    );
}



    public function store(Request $request)
{
    $utilisateur = auth()->user();

    // L'employé ne peut pas créer de paiement
    if ($utilisateur->role === 'Employe') {
        abort(
            403,
            'Accès refusé. Les employés ne peuvent pas créer de paiements.'
        );
    }

    $reservation = Reservation::findOrFail($request->idReservation);

    // Le Responsable ne peut créer un paiement que pour son service
    if (
        $utilisateur->role === 'Responsable'
        && $reservation->idService != $utilisateur->idService
    ) {
        abort(
            403,
            'Accès refusé. Vous ne pouvez gérer que les paiements de votre service.'
        );
    }

    $request->validate([
        'idReservation' => 'required|exists:reservations,idReservation',
        'montant' => 'required|numeric|min:0',
        'date_paiement' => 'required|date',
        'mode_paiement' => 'required',
        'statut' => 'required',
        'reference_paiement' => 'nullable|max:100',
    ]);

    Paiement::create([
        'idReservation' => $request->idReservation,
        'montant' => $request->montant,
        'date_paiement' => $request->date_paiement,
        'mode_paiement' => $request->mode_paiement,
        'statut' => $request->statut,
        'reference_paiement' => $request->reference_paiement,
    ]);

    return redirect()
        ->route('paiements.index')
        ->with('success', 'Paiement enregistré avec succès.');
}

    public function edit($id)
{
    $utilisateur = auth()->user();

    // L'employé ne peut pas modifier un paiement
    if ($utilisateur->role === 'Employe') {
        abort(
            403,
            'Accès refusé. Les employés ne peuvent pas modifier les paiements.'
        );
    }

    $paiement = Paiement::with('reservation')->findOrFail($id);

    // Le Responsable ne peut modifier que les paiements de son service
    if (
        $utilisateur->role === 'Responsable'
        && $paiement->reservation->idService != $utilisateur->idService
    ) {
        abort(
            403,
            'Accès refusé. Vous ne pouvez modifier que les paiements de votre service.'
        );
    }

    if ($utilisateur->role === 'Responsable') {
        $reservations = Reservation::where(
            'idService',
            $utilisateur->idService
        )->get();
    } else {
        $reservations = Reservation::all();
    }

    return view(
        'paiements.edit',
        compact('paiement', 'reservations')
    );
}

    public function update(Request $request, $id)
{
    $utilisateur = auth()->user();

    // L'employé ne peut pas modifier un paiement
    if ($utilisateur->role === 'Employe') {
        abort(
            403,
            'Accès refusé. Les employés ne peuvent pas modifier les paiements.'
        );
    }

    $paiement = Paiement::with('reservation')->findOrFail($id);

    // Le Responsable ne peut modifier que les paiements de son service
    if (
        $utilisateur->role === 'Responsable'
        && $paiement->reservation->idService != $utilisateur->idService
    ) {
        abort(
            403,
            'Accès refusé. Vous ne pouvez modifier que les paiements de votre service.'
        );
    }

    $paiement->update($request->all());

    return redirect()->route('paiements.index');
}

   public function payer($id)
{
    $utilisateur = auth()->user();

if ($utilisateur->role === 'Employe') {
    abort(
        403,
        'Accès refusé. Les employés ne peuvent pas gérer les paiements.'
    );
}
    // On récupère la réservation
    $reservation = Reservation::with('detailReservations')
        ->findOrFail($id);

    // Vérifier que la réservation peut être payée
    if ($reservation->statut !== 'En_attente') {
        return redirect()
            ->route('reservations.show', $reservation->idReservation)
            ->with('error', 'Cette réservation ne peut pas être payée.');
    }

    // Calcul du montant total de la réservation
    $montant = $reservation->detailReservations->sum(function ($detail) {
        return $detail->prix * $detail->quantite;
    });

    // Vérifier s'il existe déjà un paiement en attente
    $paiement = Paiement::where('idReservation', $reservation->idReservation)
        ->where('statut', 'En_attente')
        ->first();

    // Si aucun paiement n'existe, on le crée
    if (!$paiement) {
        $paiement = Paiement::create([
            'idReservation' => $reservation->idReservation,
            'montant' => $montant,
            'date_paiement' => now()->toDateString(),
            'mode_paiement' => 'Especes',
            'statut' => 'En_attente',
            'reference_paiement' => null,
        ]);
    }

    // Redirection vers la page de confirmation
    return redirect()
        ->route('paiements.confirmation', $paiement->idPaiement);
}

public function confirmation($id)
{

$utilisateur = auth()->user();

if ($utilisateur->role === 'Employe') {
    abort(
        403,
        'Accès refusé. Les employés ne peuvent pas gérer les paiements.'
    );
}
    $paiement = Paiement::with('reservation')->findOrFail($id);

    if ($paiement->statut !== 'En_attente') {
        return redirect()
            ->route('paiements.index')
            ->with('error', 'Ce paiement a déjà été traité.');
    }

    return view('paiements.confirmer', compact('paiement'));
}

public function confirmerPaiement(Request $request, $id)
{
    $utilisateur = auth()->user();

if ($utilisateur->role === 'Employe') {
    abort(
        403,
        'Accès refusé. Les employés ne peuvent pas gérer les paiements.'
    );
}
    $paiement = Paiement::findOrFail($id);

    if ($paiement->statut !== 'En_attente') {
        return redirect()
            ->route('paiements.index')
            ->with('error', 'Ce paiement a déjà été traité.');
    }

    $request->validate([
        'mode_paiement' => 'required|in:Especes,Orange_Money,MTN MoMo',
        'reference_paiement' => 'nullable|max:100',
    ]);

    $paiement->update([
        'mode_paiement' => $request->mode_paiement,
        'reference_paiement' => $request->reference_paiement,
        'statut' => 'payer',
        'date_paiement' => now()->toDateString(),
    ]);

    if ($paiement->reservation) {
        $paiement->reservation->update([
            'statut' => 'Confirmee',
        ]);
    }

    return redirect()
        ->route('paiements.index')
        ->with('success', 'Paiement confirmé avec succès.');
}
    public function destroy($id)
{
    $utilisateur = auth()->user();

    // L'employé ne peut pas supprimer un paiement
    if ($utilisateur->role === 'Employe') {
        abort(
            403,
            'Accès refusé. Les employés ne peuvent pas supprimer les paiements.'
        );
    }

    $paiement = Paiement::with('reservation')->findOrFail($id);

    // Le Responsable ne peut supprimer que les paiements de son service
    if (
        $utilisateur->role === 'Responsable'
        && $paiement->reservation->idService != $utilisateur->idService
    ) {
        abort(
            403,
            'Accès refusé. Vous ne pouvez supprimer que les paiements de votre service.'
        );
    }

    $paiement->delete();

    return redirect()
        ->route('paiements.index')
        ->with('success', 'Paiement supprimé avec succès.');
}
}