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

use Modules\Roles\Http\Controllers\RolesController;


Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_roles'])->as('admin.')->group(function () {
    Route::resource('roles', RolesController::class);
});
