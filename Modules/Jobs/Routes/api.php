<?php

use Modules\Jobs\Http\Controllers\Api\JobsController;

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

Route::as('api.')->group(function () {
    Route::resource('jobs', JobsController::class);
    Route::get('/search/jobs', [JobsController::class, 'search'])->name('search.jobs');
});
