<?php

use App\Http\Controllers\Tenant\CompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->name('tenants.company')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('index');
    Route::post('/', [CompanyController::class, 'store'])->name('store');
    Route::get('/{domain}', [CompanyController::class, 'show'])->name('show');
    Route::put('/{domain}', [CompanyController::class, 'update'])->name('update');
    Route::delete('/{domain}', [CompanyController::class, 'destroy'])->name('destroy');
});

