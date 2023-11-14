<?php

use Illuminate\Support\Facades\Route;

Route::get('404', function () {
    return view('errors.404-tenant');
})->name('404.tenant');

Route::get('/', function () {
    return view('welcome');
});
