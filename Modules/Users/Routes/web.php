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


use Modules\Users\Http\Controllers\UsersController;

Route::prefix('admin')->middleware(['auth', 'verified', 'password.confirm', 'permission:browse_users'])->as('admin.')->group(function () {
    Route::resource('users', UsersController::class)->except([ 'destroy' ]);
    Route::delete('users/{selected}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('users/verification/send/{user}', [UsersController::class, 'sendEmailVerificationNotification'])->name('users.verification.send');
});
