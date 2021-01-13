<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('user', [UserController::class, 'index']);
//Route::post('user', [UserController::class, 'store']);
//Route::get('user',  [UserController::class, 'show']);
//Route::delete('user/{id}', [UserController::class, 'destroy']);

Route::apiResource('user', UserController::class);

//Route::apiResource('image', ImageController::class);
Route::get('image', [ImageController::class, 'index']);
Route::post('image', [ImageController::class, 'store']);
