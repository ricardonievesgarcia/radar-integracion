<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'session.activity',
])->group(function () {

    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');

     Route::get('/seguridad/prueba', function () {
        return 'Acceso autorizado al módulo de seguridad';
    })
        ->middleware('permission:seguridad.usuarios.view')
        ->name('seguridad.prueba');

});
