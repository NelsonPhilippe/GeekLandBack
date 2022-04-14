<?php

use App\Http\Controllers\User\SettingsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\ArticleController;
use App\Models\Article;

Route::get('/home', [HomeController::class, 'index']);


Route::post('/search', [ArticleController::class, 'getArticlesWithName']);

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
    Route::post('/delete_card', [SettingsController::class, 'removeCard']);
    Route::post('/additem', [ArticleController::class, 'addItemToBasket']);
    Route::post('/remove_item', [ArticleController::class, 'removeItemToBasket']);
    Route::get('/remove_account', [LoginController::class, 'removeAccount']);
});
