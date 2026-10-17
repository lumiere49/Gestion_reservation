<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class EspaceController extends Controller
{
    /**
     * Espace du responsable
     */
    public function responsable()
    {
        $utilisateur = Auth::user();

        return view('responsable.dashboard', compact('utilisateur'));
    }

    /**
     * Espace de l'employé
     */
    public function employe()
    {
        $utilisateur = Auth::user();

        return view('employe.dashboard', compact('utilisateur'));
    }
}

