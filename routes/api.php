<?php

use App\Http\Controllers\User\SettingsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;



Route::get('/home', [HomeController::class, 'index']);


Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'admin'], function (){
    Route::post('/register_articles', [AdminController::class, 'createArticle']);
});



Route::group(['prefix' => 'auth'], function() {
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/register', [LoginController::class, 'register']);

});




Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'settings'], function() {
    Route::get('/profile', [SettingsController::class, 'profile']);
    Route::post('/card_register', [SettingsController::class, 'addCard']);
});
