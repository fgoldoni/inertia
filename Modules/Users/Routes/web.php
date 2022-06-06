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

Route::get('users', [UsersController::class, 'index'])
    ->name('admin.users.index')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('admin.users.create')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('admin.users.edit')
    ->middleware('auth');


