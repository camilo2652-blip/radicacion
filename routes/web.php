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

use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/admin/usuarios', [AdminController::class, 'index'])->name('admin.usuarios.index');
        Route::get('/admin/usuarios/create', [AdminController::class, 'create'])->name('admin.usuarios.create');
        Route::post('/admin/usuarios', [AdminController::class, 'store'])->name('admin.usuarios.store');
    });
});



//use App\Http\Controllers\NotificacionController;

Route::middleware(['auth'])->group(function () {
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('ciudadano.notificaciones');
    Route::get('/notificaciones/{id}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.leida');
});

// 🧩 DASHBOARD ADMINISTRADOR


Route::middleware(['auth', 'checkrole:administrador'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/usuarios', [AdminController::class, 'store'])->name('admin.usuarios.store');
    Route::put('/admin/usuarios/{id}', [AdminController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/admin/usuarios/{id}', [AdminController::class, 'destroy'])->name('admin.usuarios.destroy');
Route::middleware(['auth', 'checkrole:administrador'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    // Usuarios
    Route::get('/usuarios', [App\Http\Controllers\AdminUsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/usuarios/crear', [App\Http\Controllers\AdminUsuarioController::class, 'create'])->name('admin.usuarios.create');
    Route::post('/usuarios', [App\Http\Controllers\AdminUsuarioController::class, 'store'])->name('admin.usuarios.store');
    Route::get('/usuarios/{id}/editar', [App\Http\Controllers\AdminUsuarioController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/usuarios/{id}', [App\Http\Controllers\AdminUsuarioController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/usuarios/{id}', [App\Http\Controllers\AdminUsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');

    // Histórico de radicaciones
    Route::get('/historico', [App\Http\Controllers\AdminController::class, 'historico'])->name('admin.historico');
});


});


// 🧩 DASHBOARD VENTANILLA
Route::middleware(['auth', 'checkrole:ventanilla'])->group(function () {
    Route::get('/ventanilla/dashboard', function () {
        return view('ventanilla.dashboard');
    })->name('ventanilla.dashboard');
});

// 🧩 DASHBOARD DEPENDENCIA
Route::middleware(['auth', 'checkrole:dependencia'])->group(function () {
    Route::get('/dependencia/dashboard', function () {
        return view('dependencia.dashboard');
    })->name('dependencia.dashboard');
});


require __DIR__ . '/auth.php';
