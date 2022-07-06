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


use Modules\Attachments\Http\Controllers\AttachmentsController;
use Modules\Attachments\Http\Controllers\AvatarsController;

Route::prefix('admin')->middleware([
    'auth',
    'verified',
    'permission:browse_attachments'
])->as('admin.')->group(function () {
    Route::resource('attachments', AttachmentsController::class);
    Route::post('attachments/avatars', [AvatarsController::class, 'store'])->name('attachments.avatars.store');
    Route::delete('attachments/avatars/{filename}/{model}/destroy', [AvatarsController::class, 'destroy'])
        ->name('attachments.avatars.destroy');
});
