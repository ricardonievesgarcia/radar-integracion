<?php

use Illuminate\Support\Facades\Route;



Route::middleware([
    'auth',
    'session.activity',
])->group(function () {

    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');

});
