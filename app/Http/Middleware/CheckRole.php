<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Si no hay usuario autenticado → redirige al login
        if (!$user) {
            return redirect()->route('login');
        }

        // Si el rol del usuario está permitido → continúa
        if (in_array($user->rol, $roles)) {
            return $next($request);
        }

        // Caso contrario → error 403
        abort(403, 'No autorizado');
    }
}
