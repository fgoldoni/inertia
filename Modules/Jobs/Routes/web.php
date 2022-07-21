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

use Modules\Jobs\Http\Controllers\JobsController;

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_jobs'])->as('admin.')->group(function () {
    Route::resource('jobs', JobsController::class)->except(['destroy']);
    Route::delete('jobs/{selected}', [JobsController::class, 'destroy'])->name('jobs.destroy');
    Route::put('jobs/{id}/restore', [JobsController::class, 'restore'])->name('jobs.restore');
});
