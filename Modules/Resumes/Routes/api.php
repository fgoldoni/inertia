<?php

use Modules\Resumes\Http\Controllers\Api\ResumesController;

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
    Route::resource('resumes', ResumesController::class)->except(['destroy']);
    Route::delete('resumes/destroy', [ResumesController::class, 'destroy'])->name('resumes.destroy');
});
