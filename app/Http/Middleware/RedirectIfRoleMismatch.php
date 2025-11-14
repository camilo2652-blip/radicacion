<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfRoleMismatch
{
    /**
     * Manejar una solicitud entrante.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->rol !== $role) {
            // Redirige automáticamente al dashboard del rol correcto
            switch (Auth::user()->rol) {
                case 'administrador':
                    return redirect()->route('admin.dashboard');
                case 'ciudadano':
                    return redirect()->route('ciudadano.dashboard');
                case 'ventanilla':
                    return redirect()->route('ventanilla.dashboard');
                case 'dependencia':
                    return redirect()->route('dependencia.dashboard');
            }
        }

        return $next($request);
    }
}
