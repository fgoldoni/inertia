<?php

use Illuminate\Http\Request;
use Modules\Countries\Http\Controllers\Api\CitiesController;
use Modules\Countries\Http\Controllers\Api\CountriesController;
use Modules\Countries\Http\Controllers\Api\DivisionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(CountriesController::class)->prefix('countries')->name('api.countries.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(CitiesController::class)->prefix('cities')->name('api.cities.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(DivisionsController::class)->prefix('divisions')->name('api.divisions.')->group(function () {
    Route::get('/', 'index')->name('index');
});
