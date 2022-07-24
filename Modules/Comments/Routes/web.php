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

use Modules\Comments\Http\Controllers\CommentsController;

Route::prefix('admin')
    ->middleware(['auth', 'verified', 'permission:browse_comments'])
    ->as('admin.')
    ->group(function () {
        Route::resource('comments', CommentsController::class)->except(['destroy']);
        Route::delete('comments/{selected}', [CommentsController::class, 'destroy'])->name('comments.destroy');
        Route::put('comments/{id}/restore', [CommentsController::class, 'restore'])->name('comments.restore');
    });
