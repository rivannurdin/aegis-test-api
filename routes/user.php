<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController');

    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('profile', 'ProfileController');
        Route::post('logout', 'LogoutController');
    });
});
