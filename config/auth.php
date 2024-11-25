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
        ]
    ],

    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'user' => [
            'provider' => 'user',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
