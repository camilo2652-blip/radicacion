<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar formulario de registro
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Guardar nuevo usuario (ciudadano)
     */
    public function store(Request $request)
    {
        // 1️⃣ Validación de campos
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2️⃣ Crear usuario en base de datos
        $user = User::create([
            'nombre' => $request->nombre,
            'documento' => $request->documento,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'password' => Hash::make($request->password),
            'rol' => 'ciudadano', // ✅ forzamos rol ciudadano
        ]);

        // 3️⃣ Evento de registro
        event(new Registered($user));

        // 4️⃣ Loguear usuario automáticamente
        Auth::login($user);

        // 5️⃣ Redirigir a dashboard
        return redirect()->route('ciudadano.dashboard');
    }
}
