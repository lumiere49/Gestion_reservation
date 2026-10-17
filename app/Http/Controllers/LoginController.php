<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Afficher la page de connexion
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Traiter la connexion
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['mot_de_passe'],
        ])) {

            $request->session()->regenerate();

$utilisateur = Auth::user();

if ($utilisateur->role === 'Administrateur') {
    return redirect()->route('dashboard');
}

if ($utilisateur->role === 'Responsable') {
    return redirect()->route('responsable.dashboard');
}

if ($utilisateur->role === 'Employe') {
    return redirect()->route('employe.dashboard');
}

Auth::logout();

return redirect()->route('login')->withErrors([
    'email' => 'Rôle utilisateur non reconnu.',
]);
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}