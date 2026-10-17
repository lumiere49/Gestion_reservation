<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use App\Models\Service;
use Illuminate\Http\Request;

class PrestationController extends Controller
{
    public function index(Request $request)
{
    $query = Prestation::with('service');

    if ($request->filled('idService')) {
        $query->where('idService', $request->idService);
    }

    $prestations = $query->get();

    return view('prestations.index', compact('prestations'));
}

public function byService($idService)
    {
        $prestations = Prestation::where('idService', $idService)->get();

        return response()->json($prestations);
    }

   public function show($id)
{
    $utilisateur = auth()->user();

    $prestation = Prestation::with('service')->findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $prestation->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez consulter que les prestations de votre service.');
    }

    return view('prestations.show', compact('prestation'));
}

    public function create()
    {
        $services = Service::all();

        return view('prestations.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'duree' => 'required',
            'description' => 'nullable',
            'idService' => 'required'
        ]);

        Prestation::create($request->all());

        return redirect()->route('prestations.index');
    }

    public function edit($id)
{
    $utilisateur = auth()->user();

    $prestation = Prestation::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $prestation->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez modifier que les prestations de votre service.');
    }

    if ($utilisateur->role === 'Administrateur') {
        $services = Service::all();
    } else {
        $services = Service::where(
            'idService',
            $utilisateur->idService
        )->get();
    }

    return view('prestations.edit', compact('prestation', 'services'));
}

    public function update(Request $request, $id)
{
    $utilisateur = auth()->user();

    $prestation = Prestation::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $prestation->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez modifier que les prestations de votre service.');
    }

    $prestation->update($request->all());

    return redirect()->route('prestations.index');
}

    public function destroy($id)
{
    $utilisateur = auth()->user();

    $prestation = Prestation::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $prestation->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez supprimer que les prestations de votre service.');
    }

    $prestation->delete();

    return redirect('/prestations')
        ->with('success', 'Prestation supprimée avec succès.');
}
}