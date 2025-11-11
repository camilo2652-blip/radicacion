<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;

class NotificacionController extends Controller
{
    public function index()
    {
        // Buscar notificaciones que pertenecen a los radicados del usuario autenticado
        $notificaciones = Notificacion::whereHas('radicado', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('ciudadano.notificaciones', compact('notificaciones'));
    }

    public function marcarLeida($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->update(['leido' => true]);

        return back()->with('success', 'Notificación marcada como leída.');
    }
}
    
