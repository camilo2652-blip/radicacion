<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Mostrar la vista de login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Manejar la autenticación
     */
    public function store(Request $request): RedirectResponse
{
    // Validar campos solo email y password
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    // Intentar login con email + password
    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => __('Las credenciales no coinciden.'),
        ]);
    }

    // Login exitoso
    $request->session()->regenerate();

    // Redirigir según rol automáticamente
    switch(Auth::user()->rol) {
        case 'administrador':
            return redirect()->route('admin.dashboard');
        case 'ventanilla':
            return redirect()->route('ventanilla.dashboard');
        case 'dependencia':
            return redirect()->route('dependencia.dashboard');
        case 'ciudadano':
            return redirect()->route('ciudadano.dashboard');
        default:
            return redirect()->route('dashboard');
    }
}

    /**
     * Cerrar sesión
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
