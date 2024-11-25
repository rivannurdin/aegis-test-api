<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'admin'),
        'passwords' => 'admin',
    ],

    'guards' => [
        'admin' => [
            'driver' => 'jwt',
            'provider' => 'admin',
        ],
        'cashier' => [
            'driver' => 'jwt',
            'provider' => 'cashier'
        ]
    ],

    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'cashier' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ]
    ],

    'passwords' => [
        'admin' => [
            'provider' => 'user',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'cashier' => [
            'provider' => 'cashier',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ]
    ],

    'password_timeout' => 10800,

];
