<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radicado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RadicadoController extends Controller
{
    /**
     * Mostrar lista de radicados del ciudadano autenticado
     */
    public function index()
    {
        $radicados = Radicado::where('user_id', Auth::id())->latest()->get();
        return view('ciudadano.radicados.index', compact('radicados'));
    }

    /**
     * Mostrar formulario de creación de radicado
     */
    public function create()
    {
        return view('ciudadano.radicados.create');
    }

    /**
     * Guardar un nuevo radicado
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'asunto' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:51200',
    ]);

    $numero = 'RAD-' . now()->format('Ymd') . '-' . \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(5));

    $rutaArchivo = $request->hasFile('archivo')
        ? $request->file('archivo')->store('radicados', 'public')
        : null;

    // Guardar y asignar a una variable
    $radicado = Radicado::create([
        'user_id' => \Illuminate\Support\Facades\Auth::id(),
        'numero' => $numero,
        'asunto' => $validated['asunto'],
        'descripcion' => $validated['descripcion'],
        'archivo' => $rutaArchivo,
    ]);

    // Enviar correo de confirmación
    \Illuminate\Support\Facades\Mail::to(\Illuminate\Support\Facades\Auth::user()->email)
        ->send(new \App\Mail\RadicadoCreado($radicado));

    // Mensaje de éxito
    session()->flash('success', 'El documento fue radicado correctamente. Número: ' . $numero);

    return redirect()->route('ciudadano.dashboard');
}
}