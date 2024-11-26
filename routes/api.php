<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController');
    Route::post('register', 'RegisterController');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('profile', 'ProfileController');
        Route::post('logout', 'LogoutController');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'product', 'middleware' => ['role:' . User::ADMIN_ROLE], 'namespace' => 'Product'], function () {
        Route::get('list', 'ListController');
        Route::get('detail', 'DetailController');
        Route::post('create', 'CreateController');
        Route::post('update', 'UpdateController');
        Route::delete('delete', 'DeleteController');
    }); 

    Route::group(['prefix' => 'transaction', 'namespace' => 'Transaction'], function () {
        Route::get('list', 'ListController');
        Route::get('detail', 'DetailController');
        Route::post('create', 'CreateController');
        Route::post('refund', 'RefundController');
    }); 

    Route::group(['prefix' => 'cashier', 'middleware' => ['role:' . User::ADMIN_ROLE], 'namespace' => 'Cashier'], function () {
        Route::get('list', 'ListController');
        Route::post('active', 'ActiveController');
        Route::post('inactive', 'InactiveController');
    }); 
});