<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RadicadoController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Si el usuario ya inició sesión → redirigir a su dashboard
    if (auth()->check()) {
        switch (auth()->user()->rol) {
            case 'ciudadano':
                return redirect()->route('ciudadano.dashboard');
            default:
                return redirect()->route('dashboard');
        }
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Registro y Login (solo invitados)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Dashboard general (otros roles)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Módulo Ciudadano
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkrole:ciudadano'])->prefix('ciudadano')->name('ciudadano.')->group(function () {
    // Dashboard ciudadano
    Route::get('/dashboard', function () {
        return view('ciudadano.dashboard');
    })->name('dashboard');

    // Radicados
    Route::get('/radicados', [RadicadoController::class, 'index'])->name('radicados.index');
    Route::get('/radicados/create', [RadicadoController::class, 'create'])->name('radicados.create');
    Route::post('/radicados', [RadicadoController::class, 'store'])->name('radicados.store');

    // Notificaciones
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
});

/*
|--------------------------------------------------------------------------
| Perfil de usuario (Laravel Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//use App\Http\Controllers\NotificacionController;

Route::middleware(['auth'])->group(function () {
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('ciudadano.notificaciones');
    Route::get('/notificaciones/{id}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.leida');
});

require __DIR__ . '/auth.php';
