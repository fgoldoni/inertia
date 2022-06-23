<?php

use Illuminate\Http\Request;
use Modules\Attachments\Http\Controllers\Api\AttachmentsController;
use Modules\Attachments\Http\Controllers\Api\AvatarsController;

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

Route::controller(AttachmentsController::class)->prefix('attachments')->name('api.attachments.')->group(function () {
    Route::post('/', 'store')->name('store');
    Route::delete('/{attachment}', 'destroy')->name('destroy');
});

Route::controller(AvatarsController::class)->prefix('avatars')->name('api.avatars.')->group(function () {
    Route::post('/', 'store')->name('store');
    Route::delete('/{filename}/destroy', 'destroy')->name('destroy');
});
