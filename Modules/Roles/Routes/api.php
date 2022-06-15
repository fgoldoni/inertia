<?php

use Illuminate\Http\Request;
use Modules\Roles\Http\Controllers\Api\PermissionsController;
use Modules\Roles\Http\Controllers\Api\RolesController;

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


Route::controller(PermissionsController::class)->prefix('permissions')->name('api.permissions.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(RolesController::class)->prefix('roles')->name('api.roles.')->group(function () {
    Route::get('/{role}', 'show')->name('show');
});
