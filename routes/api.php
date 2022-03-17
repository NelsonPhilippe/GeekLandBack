<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Auth\LoginController;

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
    return $request->user();
});

Route::get('/home', [HomeController::class, 'index']);


Route::group(['prefix' => 'admin'], function (){
    Route::post('/register_articles', [AdminController::class, 'article']);
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/register', [LoginController::class, 'register']);

});
