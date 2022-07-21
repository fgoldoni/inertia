<?php

use Modules\Users\Http\Controllers\Api\UsersController;
use Modules\Users\Http\Controllers\ApiTokenController;

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

Route::controller(UsersController::class)->prefix('users')->name('api.users.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(ApiTokenController::class)->prefix('sanctum/token')->name('api.sanctum.token.')->group(function () {
    Route::post('', 'store')->name('store');
    Route::post('link', 'loginLink')->name('link');
});
