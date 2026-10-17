<?php

namespace App\Http\Controllers;

use App\Models\DetailReservation;
use App\Models\Reservation;
use App\Models\Prestation;
use Illuminate\Http\Request;

class DetailReservationController extends Controller
{
    public function index()
    {
        $details = DetailReservation::with('reservation','prestation')->get();

        return view('detail_reservations.index', compact('details'));
    }

    public function create()
    {
        $reservations = Reservation::all();
        $prestations = Prestation::all();

        return view('detail_reservations.create', compact('reservations','prestations'));
    }

    public function store(Request $request)
{
    $request->validate([
        'idReservation' => 'required|exists:reservations,idReservation',
        'idPrestation' => 'required|exists:prestations,idPrestation',
        'quantite' => 'required|integer|min:1',
        'prix' => 'required|numeric|min:0',
    ]);

    DetailReservation::create([
        'idReservation' => $request->idReservation,
        'idPrestation' => $request->idPrestation,
        'quantite' => $request->quantite,
        'prix' => $request->prix,
    ]);

    return redirect()
        ->route('detail-reservations.index')
        ->with('success', 'Détail de réservation ajouté avec succès.');
}

    public function edit($id)
    {
        $detail = DetailReservation::findOrFail($id);

        $reservations = Reservation::all();
        $prestations = Prestation::all();

        return view('detail_reservations.edit', compact('detail','reservations','prestations'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'idReservation' => 'required|exists:reservations,idReservation',
        'idPrestation' => 'required|exists:prestations,idPrestation',
        'quantite' => 'required|integer|min:1',
        'prix' => 'required|numeric|min:0',
    ]);

    $detail = DetailReservation::findOrFail($id);

    $detail->update([
        'idReservation' => $request->idReservation,
        'idPrestation' => $request->idPrestation,
        'quantite' => $request->quantite,
        'prix' => $request->prix,
    ]);

    return redirect()
        ->route('detail-reservations.index')
        ->with('success', 'Détail de réservation modifié avec succès.');
}

    public function destroy($id)
    {
        DetailReservation::destroy($id);

        return redirect()->route('detail-reservations.index');
    }
}