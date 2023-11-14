<?php

use Illuminate\Support\Facades\Route;

Route::get('404', function () {
    return response()->view('errors.404-tenant', [], 404);
})->name('404.tenant');

Route::get('/', function () {
    return view('welcome');
});
