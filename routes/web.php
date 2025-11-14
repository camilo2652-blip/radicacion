<?php

use Illuminate\Support\Facades\Route;

// Controladores generales
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RadicadoController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Controladores Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUsuarioController;

/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        switch (auth()->user()->rol) {
            case 'ciudadano':
                return redirect()->route('ciudadano.dashboard');
            case 'administrador':
                return redirect()->route('admin.dashboard');
            case 'ventanilla':
                return redirect()->route('ventanilla.dashboard');
            case 'dependencia':
                return redirect()->route('dependencia.dashboard');
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
| Dashboard general
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
Route::middleware(['auth', 'redirect.role:ciudadano'])
    ->prefix('ciudadano')
    ->name('ciudadano.')
    ->group(function () {

        Route::get('/dashboard', fn() => view('ciudadano.dashboard'))->name('dashboard');

        Route::get('/radicados', [RadicadoController::class, 'index'])->name('radicados.index');
        Route::get('/radicados/create', [RadicadoController::class, 'create'])->name('radicados.create');
        Route::post('/radicados', [RadicadoController::class, 'store'])->name('radicados.store');

        Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    });

/*
|--------------------------------------------------------------------------
| Perfil usuario
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Notificaciones generales
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::get('/notificaciones/{id}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.leida');
});

/*
|--------------------------------------------------------------------------
| ADMINISTRACIÓN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'redirect.role:administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Usuarios
        Route::get('/usuarios', [AdminUsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/crear', [AdminUsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [AdminUsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{id}/editar', [AdminUsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [AdminUsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [AdminUsuarioController::class, 'destroy'])->name('usuarios.destroy');

        Route::get('/historico', [AdminController::class, 'historico'])->name('historico');
    });

/*
|--------------------------------------------------------------------------
| Ventanilla
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'redirect.role:ventanilla'])->group(function () {
    Route::get('/ventanilla/dashboard', fn() => view('ventanilla.dashboard'))->name('ventanilla.dashboard');
});

/*
|--------------------------------------------------------------------------
| Dependencia
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'redirect.role:dependencia'])->group(function () {
    Route::get('/dependencia/dashboard', fn() => view('dependencia.dashboard'))->name('dependencia.dashboard');
});

require __DIR__.'/auth.php';
