<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;


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


Route::post('login',[AuthController::class, 'login']);

Route::group(['middleware' => ['api','auth.jwt'],'prefix' => 'auth'],function ($router) {

    // auth 
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    // categories
    Route::post('categories', [CategoriesController::class, 'create']);
    // products 
    Route::get('search', [ProductsController::class, 'index']);
    Route::post('product', [ProductsController::class, 'create']);

});