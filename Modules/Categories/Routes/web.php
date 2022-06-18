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

use Modules\Categories\Http\Controllers\CategoriesController;

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_categories'])->as('admin.')->group(function () {
    Route::resource('categories', CategoriesController::class)->except([ 'destroy' ]);
});
