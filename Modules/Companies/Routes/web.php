<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Companies\Http\Controllers\CompaniesController;

Route::prefix('admin')
    ->middleware(['auth', 'verified', 'permission:browse_companies'])
    ->as('admin.')->group(function () {
        Route::resource('companies', CompaniesController::class)->except(['destroy']);
        Route::delete('companies/{selected}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
        Route::put('companies/{id}/restore', [CompaniesController::class, 'restore'])->name('companies.restore');
    });
