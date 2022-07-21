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

use Modules\Countries\Http\Controllers\CitiesController;
use Modules\Countries\Http\Controllers\CountriesController;
use Modules\Countries\Http\Controllers\DivisionsController;

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_countries'])->as('admin.')->group(function () {
    Route::resource('countries', CountriesController::class)->except(['destroy']);
    Route::delete('countries/{selected}', [CountriesController::class, 'destroy'])->name('countries.destroy');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_countries'])->as('admin.')->group(function () {
    Route::resource('divisions', DivisionsController::class)->except(['destroy']);
    Route::delete('divisions/{selected}', [DivisionsController::class, 'destroy'])->name('divisions.destroy');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_countries'])->as('admin.')->group(function () {
    Route::resource('cities', CitiesController::class)->except(['destroy']);
    Route::delete('cities/{selected}', [CitiesController::class, 'destroy'])->name('cities.destroy');
});
