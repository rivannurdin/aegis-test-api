<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'user'),
        'passwords' => 'user',
    ],


    'guards' => [
        'user' => [
            'driver' => 'jwt',
            'provider' => 'user',
        ],

        // 'authority' => [
        //     'driver' => 'jwt',
        //     'provider' => 'authority'
        // ]
    ],


    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'authority' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Models\Authority::class,
        // ]
    ],

    'passwords' => [
        'user' => [
            'provider' => 'user',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        // 'authority' => [
        //     'provider' => 'authority',
        //     'table' => 'password_resets',
        //     'expire' => 60,
        //     'throttle' => 60,
        // ]
    ],

    'password_timeout' => 10800,

];
