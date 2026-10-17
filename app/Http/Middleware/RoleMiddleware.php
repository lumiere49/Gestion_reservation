<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Vérifie que l'utilisateur possède le rôle autorisé.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier que son rôle est autorisé
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Accès refusé. Vous n’avez pas les autorisations nécessaires.');
        }

        return $next($request);
    }
}