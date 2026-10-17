<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    public function create()
{
    return view('clients.create');
}

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|max:100',
        'prenom' => 'required|max:100',
        'email' => 'required|email|unique:clients,email',
        'telephone' => 'nullable|max:20',
        'adresse' => 'nullable|max:255',
        'mot_de_passe' => 'required|min:6'
    ]);

    Client::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
        'mot_de_passe' => bcrypt($request->mot_de_passe)
    ]);

    return redirect('/clients')
           ->with('success', 'Client enregistré avec succès.');
}

public function edit($id)
{
    $client = Client::findOrFail($id);

    return view('clients.edit', compact('client'));
}

public function show($id)
{
    $client = Client::findOrFail($id);

    return view('clients.show', compact('client'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|max:100',
        'prenom' => 'required|max:100',
        'email' => 'required|email',
        'telephone' => 'required|max:20',
        'adresse' => 'nullable|max:255',
    ]);

    $client = Client::findOrFail($id);

    $client->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    return redirect('/clients')
        ->with('success', 'Client modifié avec succès.');
}

public function destroy($id)
{
    $client = Client::findOrFail($id);

    $client->delete();

    return redirect('/clients')
        ->with('success', 'Client supprimé avec succès.');
}
}
