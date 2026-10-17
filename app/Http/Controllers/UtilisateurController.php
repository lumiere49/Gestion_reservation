<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Afficher la liste des utilisateurs
     */
    public function index()
    {
        $utilisateurs = Utilisateur::with('service')
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();

        return view('utilisateurs.index', compact('utilisateurs'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $services = Service::orderBy('nom')->get();

        return view('utilisateurs.create', compact('services'));
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:utilisateurs,email',
            'telephone' => 'nullable|string|max:50',
            'adresse' => 'nullable|string|max:255',
            'mot_de_passe' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Administrateur,Responsable,Employe',
            'idService' => 'nullable|exists:services,idService',
        ]);

        /*
         * L'administrateur général n'est pas rattaché à un service.
         * Les responsables et employés doivent être affectés à un service.
         */
        if (
            in_array($validated['role'], ['Responsable', 'Employe'])
            && empty($validated['idService'])
        ) {
            return back()
                ->withErrors([
                    'idService' => 'Le service est obligatoire pour un Responsable ou un Employé.',
                ])
                ->withInput();
        }

        if ($validated['role'] === 'Administrateur') {
            $validated['idService'] = null;
        }

        $validated['mot_de_passe'] = Hash::make(
            $validated['mot_de_passe']
        );

        Utilisateur::create($validated);

        return redirect()
            ->route('utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher un utilisateur
     */
    public function show(string $id)
    {
        $utilisateur = Utilisateur::with('service')
            ->findOrFail($id);

        return view('utilisateurs.show', compact('utilisateur'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $services = Service::orderBy('nom')->get();

        return view(
            'utilisateurs.edit',
            compact('utilisateur', 'services')
        );
    }

    /**
     * Modifier un utilisateur
     */
    public function update(Request $request, string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:utilisateurs,email,' . $id . ',idUtilisateur',
            'telephone' => 'nullable|string|max:50',
            'adresse' => 'nullable|string|max:255',
            'mot_de_passe' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:Administrateur,Responsable,Employe',
            'idService' => 'nullable|exists:services,idService',
        ]);

        /*
         * Les responsables et employés doivent avoir un service.
         */
        if (
            in_array($validated['role'], ['Responsable', 'Employe'])
            && empty($validated['idService'])
        ) {
            return back()
                ->withErrors([
                    'idService' => 'Le service est obligatoire pour ce rôle.',
                ])
                ->withInput();
        }

        /*
         * L'administrateur général n'est rattaché à aucun service.
         */
        if ($validated['role'] === 'Administrateur') {
            $validated['idService'] = null;
        }

        /*
         * Ne modifier le mot de passe que s'il a été renseigné.
         */
        if (!empty($validated['mot_de_passe'])) {
            $validated['mot_de_passe'] = Hash::make(
                $validated['mot_de_passe']
            );
        } else {
            unset($validated['mot_de_passe']);
        }

        $utilisateur->update($validated);

        return redirect()
            ->route('utilisateurs.index')
            ->with('success', 'Utilisateur modifié avec succès.');
    }

    /**
     * Supprimer un utilisateur
     */
    public function destroy(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        /*
         * Protection du compte administrateur général.
         * On évite de supprimer accidentellement le compte principal.
         */
        if ($utilisateur->idUtilisateur == 1) {
            return redirect()
                ->route('utilisateurs.index')
                ->with('error', 'Le compte administrateur principal ne peut pas être supprimé.');
        }

        $utilisateur->delete();

        return redirect()
            ->route('utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}