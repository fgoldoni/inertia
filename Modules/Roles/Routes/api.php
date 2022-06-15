<?php

use Illuminate\Http\Request;
use Modules\Roles\Http\Controllers\Api\PermissionsController;

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

Route::middleware('auth:api')->get('/roles', function (Request $request) {
    return $request->user();
});

Route::controller(PermissionsController::class)->group(function () {
    Route::get('/permissions', 'index')->name('permissions.index');
});
