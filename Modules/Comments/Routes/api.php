<?php

use Illuminate\Http\Request;
use Modules\Comments\Http\Controllers\Api\CommentsController;

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
    Route::resource('comments', CommentsController::class)->except(['destroy']);
    Route::delete('comments/destroy', [CommentsController::class, 'destroy'])->name('comments.destroy');
});
