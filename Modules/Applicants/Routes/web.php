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

use Modules\Applicants\Http\Controllers\ApplicantsController;

Route::prefix('admin')
    ->middleware(['auth', 'verified', 'permission:browse_applicants'])
    ->as('admin.')
    ->group(function () {
        Route::resource('applicants', ApplicantsController::class)->except(['destroy']);
        Route::delete('applicants/{selected}', [ApplicantsController::class, 'destroy'])->name('applicants.destroy');
        Route::put('applicants/{id}/restore', [ApplicantsController::class, 'restore'])->name('applicants.restore');
        Route::put('applicants/status/{applicant}/update', [ApplicantsController::class, 'updateStatus'])
            ->name('applicants.status.update');
    });
