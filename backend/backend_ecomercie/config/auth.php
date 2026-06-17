<?php

use App\Models\User;
use App\Models\Client;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [

        // Web (Laravel padrão - admin/painel se quiser)
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Sanctum (API com Client)
        'sanctum' => [
            'driver' => 'sanctum',
            'provider' => 'clients',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [

        // Usuário padrão Laravel (opcional)
        'users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ],

        // Cliente da sua API (PRINCIPAL NO SEU CASO)
        'clients' => [
            'driver' => 'eloquent',
            'model' => Client::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset
    |--------------------------------------------------------------------------
    */

    'passwords' => [

        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];