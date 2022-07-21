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

use Modules\Dashboard\Http\Controllers\DashboardController;
use Modules\Dashboard\Http\Controllers\DashboardUserController;

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:access_dashboard'])->as('admin.')->group(function () {
    Route::resource('dashboard', DashboardController::class)->except(['destroy']);
    Route::delete('dashboard/{selected}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
    Route::get('load/data', [DashboardController::class, 'loadData'])->name('dashboard.load.data');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:access_dashboard'])->as('admin.')->group(function () {
    Route::put('/dashboard/user/{id}', [DashboardUserController::class, 'update'])->name('dashboard.user.update');
});
