<?php
use Illuminate\Support\Facades\Route;
use Codershout\GGLink\Http\Controllers\GGLinkAuthController;


Route::group(['namespace' => 'Codershout\GGLink\Http\Controllers'], function () {
    Route::get('login', [GGLinkAuthController::class, 'getLoginForm'])->name('login');
    Route::post('login', [GGLinkAuthController::class, 'postLogin']);

    Route::group(['middleware' => 'auth.user'], function () {
        Route::get('home', [GGLinkAuthController::class, 'home'])->name('home');
        Route::get('logout', [GGLinkAuthController::class, 'logout'])->name('logout');
        Route::get('profile', [GGLinkAuthController::class, 'profile'])->name('profile');
    });
});
