<?php

use Illuminate\Http\Request;
use Modules\Teams\Http\Controllers\Api\TeamsController;

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

Route::middleware('auth:api')->get('/teams', fn (Request $request) => $request->user());

Route::controller(TeamsController::class)->prefix('teams')->name('api.teams.')->group(function () {
    Route::get('{subdomain}', 'show')
        ->name('show')
        ->where('subdomain', '[a-z\-]+');

    Route::get('', 'index')
        ->name('index');
});
