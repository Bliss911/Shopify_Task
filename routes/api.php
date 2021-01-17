<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
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
//Route::group(['prefix' => 'auth'], function () {
//Route::middleware('auth:api')->group(function (){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('image', [ImageController::class, 'index'])->name('home');

//    Route::group(['middleware' => 'auth:api'], function () {
        Route::middleware('auth:api')->group(function (){

            Route::get('user', [UserController::class, 'index']);
            Route::get('user/{id}',  [UserController::class, 'show']);
            Route::delete('user/{id}', [UserController::class, 'destroy']);
            Route::post('logout', [AuthController::class,'logout']);

            Route::post('image', [ImageController::class, 'store']);
            Route::delete('image/{id}', [ImageController::class, 'destroy']);



            Route::post('order', [OrderController::class,'create']);
            Route::get('order/{id}', [OrderController::class,'getOne']);

            Route::get('allOrders', [OrderController::class,'allOrders']);


        });
//});


Route::post('cart', [\App\Http\Controllers\CartController::class, 'store']);

Route::post('search', [ImageController::class, 'filter']);

