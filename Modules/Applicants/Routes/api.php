<?php

use Illuminate\Http\Request;
use Modules\Applicants\Http\Controllers\Api\ApplicantsController;

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

Route::middleware('auth:sanctum')->as('api.')->group(function () {
    Route::resource('applicants', ApplicantsController::class)->except(['destroy', 'store']);
    Route::delete('applicants/destroy', [ApplicantsController::class, 'destroy'])->name('applicants.destroy');
});

Route::as('api.')->group(function () {
    Route::post('applicants', [ApplicantsController::class, 'store'])->name('applicants.store');
});
