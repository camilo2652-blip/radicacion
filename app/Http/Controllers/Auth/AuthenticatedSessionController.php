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
        // Validar campos
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'rol' => 'required|string|in:ciudadano,ventanilla,dependencia,administrador',
        ]);

        // Intentar login con email + password + rol
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'rol' => $request->rol
        ], $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => __('Las credenciales no coinciden con el rol seleccionado.'),
            ]);
        }

        // Login exitoso
        $request->session()->regenerate();

        // 🔹 Aquí va tu switch para redirigir según rol
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
            return redirect(RouteServiceProvider::HOME);
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
