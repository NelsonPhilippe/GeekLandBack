<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Auth\LoginController;



Route::get('/home', [HomeController::class, 'index']);


// Route::group(['prefix' => 'admin'], function (){
//     Route::post('/register_articles', [AdminController::class, 'article']);
// });

Route::group(['middleware' => 'api','prefix' => 'auth'], function() {
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/register', [LoginController::class, 'register']);
    Route::get('/profile', [LoginController::class, 'profile']);
});


Route::group(['prefix' => 'user_settings'], function() {
    // Route::get('information', );
});
