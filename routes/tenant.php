<?php

use App\Http\Controllers\Tenant\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'ola';
});

Route::get('company/store', [CompanyController::class, 'store'])->name('tenant.store');
