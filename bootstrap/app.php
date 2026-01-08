<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\IsAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan middleware alias
        $middleware->alias([
            'admin' => IsAdmin::class,
        ]);
        
        // Konfigurasi redirect untuk guest
        $middleware->redirectGuestsTo('/login');
        
        // JANGAN gunakan redirectUsersTo jika menggunakan Laravel Breeze/Jetstream
        // Biarkan RouteServiceProvider atau auth.php yang handle redirect
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    