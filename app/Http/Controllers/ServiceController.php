<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
{
    $utilisateur = auth()->user();

    if (
        $utilisateur->role === 'Administrateur'
        || $utilisateur->role === 'Employe'
    ) {
        $services = Service::all();
    } else {
        $services = Service::where(
            'idService',
            $utilisateur->idService
        )->get();
    }

    return view('services.index', compact('services'));
}

    public function show($id)
{
    $utilisateur = auth()->user();

    $service = Service::with('prestations')->findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $service->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez consulter que votre service.');
    }

    return view('services.show', compact('service'));
}

    public function create()
{
    if (auth()->user()->role !== 'Administrateur') {
        abort(403, 'Accès refusé. Seul l’administrateur peut créer un service.');
    }

    return view('services.create');
}

       public function store(Request $request)
{
    if (auth()->user()->role !== 'Administrateur') {
        abort(403, 'Accès refusé. Seul l’administrateur peut créer un service.');
    }

    $request->validate([
        'nom' => 'required|max:100',
        'description' => 'nullable',
        'telephone' => 'required|max:20',
        'adresse' => 'required|max:255',
        'heure_ouverture' => 'required',
        'heure_fermeture' => 'required',
    ]);

    Service::create($request->all());

    return redirect()->route('services.index')
        ->with('success', 'Service ajouté avec succès.');
}

    public function edit($id)
{
    $utilisateur = auth()->user();

    $service = Service::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $service->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez modifier que votre service.');
    }

    return view('services.edit', compact('service'));
}

    public function update(Request $request, $id)
{
    $utilisateur = auth()->user();

    $service = Service::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $service->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez modifier que votre service.');
    }

    $request->validate([
        'nom' => 'required|max:100',
        'description' => 'nullable',
        'telephone' => 'required|max:20',
        'adresse' => 'required|max:255',
        'heure_ouverture' => 'required',
        'heure_fermeture' => 'required',
    ]);

    $service->update($request->all());

    return redirect()->route('services.index')
        ->with('success', 'Service modifié.');
}

   public function destroy($id)
{
    $utilisateur = auth()->user();

    $service = Service::findOrFail($id);

    if (
        $utilisateur->role !== 'Administrateur'
        && $service->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez supprimer que votre service.');
    }

    $service->delete();

    return redirect()->route('services.index')
        ->with('success', 'Service supprimé.');
}
}