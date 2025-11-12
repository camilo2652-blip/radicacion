<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Radicado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Mostrar el panel principal
    public function index(Request $request)
{
    // 🔹 Filtros de búsqueda
    $estado = $request->input('estado');
    $busqueda = $request->input('busqueda');
    $fecha = $request->input('fecha');

    // 🔹 Consulta base
    $radicadosQuery = \App\Models\Radicado::with('ciudadano')->orderBy('id', 'desc');

    // Filtro por estado
    if ($estado) {
        $radicadosQuery->where('estado', $estado);
    }

    // Filtro por palabra clave (nombre, documento o número de radicado)
    if ($busqueda) {
        $radicadosQuery->whereHas('ciudadano', function ($q) use ($busqueda) {
            $q->where('nombre', 'like', "%$busqueda%")
              ->orWhere('documento', 'like', "%$busqueda%");
        })->orWhere('numero', 'like', "%$busqueda%");
    }

    // Filtro por fecha
    if ($fecha) {
        $radicadosQuery->whereDate('created_at', $fecha);
    }

    $radicados = $radicadosQuery->get();
    $usuarios = \App\Models\User::orderBy('id', 'desc')->get();

    return view('admin.dashboard', compact('usuarios', 'radicados', 'estado', 'busqueda', 'fecha'));
}


    // Crear usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'rol' => 'required|string',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        return redirect()->back()->with('success', 'Usuario creado correctamente');
    }

    // Editar usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'rol' => $request->rol,
        ]);

        if ($request->filled('password')) {
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->back()->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Usuario eliminado correctamente');
    }
}
