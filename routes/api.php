<?php

use App\Http\Controllers\User\SettingsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\ArticleController;

Route::get('/home', [HomeController::class, 'index']);


Route::post('/search', [ArticleController::class, 'getArticlesWithName']);
Route::post('/reset_password', [ArticleController::class, 'reset_password']);

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'admin'], function (){
    Route::post('/register_articles', [AdminController::class, 'create_article']);
});



Route::group(['prefix' => 'auth'], function() {
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/register', [LoginController::class, 'register']);
});




Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'settings'], function() {
    Route::get('/profile', [SettingsController::class, 'profile']);
    Route::post('/card_register', [SettingsController::class, 'add_card']);
    Route::post('/delete_card', [SettingsController::class, 'remove_card']);
    Route::get('/get_card',  [SettingsController::class, 'get_card']);
    Route::get('/get_profile',  [SettingsController::class, 'profile']);
    Route::post('/additem', [ArticleController::class, 'addItemToBasket']);
    Route::post('/remove_item', [ArticleController::class, 'removeItemToBasket']);
    Route::get('/remove_account', [LoginController::class, 'removeAccount']);
});
