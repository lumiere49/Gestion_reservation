<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use App\Models\Service;
use Illuminate\Http\Request;

class RessourceController extends Controller
{
    public function index(Request $request)
{
    $utilisateur = auth()->user();

    $query = Ressource::with('service');

    if ($utilisateur->role === 'Responsable') {
        $query->where('idService', $utilisateur->idService);
    }

    if ($request->filled('idService')) {
        $query->where('idService', $request->idService);
    }

    $ressources = $query->get();

    return view('ressources.index', compact('ressources'));
}
public function show($id)
{
    $utilisateur = auth()->user();

    $ressource = Ressource::with('service')->findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $ressource->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez consulter que les ressources de votre service.');
    }

    return view('ressources.show', compact('ressource'));
}

    public function create()
    {
        $services = Service::all();

        return view('ressources.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'type' => 'required',
            'etat' => 'required',
            'capacite' => 'required|integer',
            'description' => 'nullable',
            'idService' => 'required'
        ]);

        Ressource::create($request->all());

        return redirect()->route('ressources.index');
    }

    public function edit($id)
{
    $utilisateur = auth()->user();

    $ressource = Ressource::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $ressource->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez modifier que les ressources de votre service.');
    }

    if ($utilisateur->role === 'Administrateur') {
        $services = Service::all();
    } else {
        $services = Service::where(
            'idService',
            $utilisateur->idService
        )->get();
    }

    return view('ressources.edit', compact('ressource', 'services'));
}

    public function update(Request $request, $id)
{
    $utilisateur = auth()->user();

    $ressource = Ressource::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $ressource->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez modifier que les ressources de votre service.');
    }

    $ressource->update($request->all());

    return redirect()->route('ressources.index');
}

    public function destroy($id)
{
    $utilisateur = auth()->user();

    $ressource = Ressource::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $ressource->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez supprimer que les ressources de votre service.');
    }

    $ressource->delete();

    return redirect('/ressources')
        ->with('success', 'Ressource supprimée avec succès.');
}
}