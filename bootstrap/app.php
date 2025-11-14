<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\EsAdministrador; // 👈 Agrega esta línea
//use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 👇 Aquí registras tus middlewares personalizados
        $middleware->alias([
            'checkrole' => CheckRole::class,
            'esadmin' => EsAdministrador::class, // 👈 Agrega este alias
            //'admin' => \App\Http\Middleware\AdminAccess::class,
            'redirect.role' => App\Http\Middleware\RedirectIfRoleMismatch::class,
        ]);


        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();


    