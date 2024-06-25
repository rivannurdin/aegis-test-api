<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController');
    // Route::post('register', 'RegisterController');
    // Route::post('reset_password', 'ResetPasswordController');

    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('profile', 'ProfileController');
    //     Route::post('profile/update', 'ProfileUpdateController');
    //     Route::post('fcm/update', 'FCMUpdateController');
    //     Route::post('logout', 'LogoutController');
    //     Route::post('change_password', 'ChangePasswordController');
    });
});
