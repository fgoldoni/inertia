<?php

use Illuminate\Http\Request;
use Modules\Users\Http\Controllers\Api\UsersController;

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
