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


use Modules\Countries\Http\Controllers\CountriesController;

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_countries'])->as('admin.')->group(function () {
    Route::resource('countries', CountriesController::class)->except([ 'destroy' ]);
    Route::delete('countries/{selected}', [CountriesController::class, 'destroy'])->name('countries.destroy');
});
