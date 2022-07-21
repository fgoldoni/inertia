<?php

use App\Repositories\Criteria\EagerLoad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Users\Repositories\Contracts\UsersRepository;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return app()->make(UsersRepository::class)->withCriteria([
        new EagerLoad(['attachments' => function ($query) use ($request) {
            $query->where('type', 'resumes');
        }]),
    ])->find($request->user()->id, ['id', 'name', 'email', 'profile_photo_path']);
});
