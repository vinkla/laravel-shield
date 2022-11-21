<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-shield
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Password Authenticator
    |--------------------------------------------------------------------------
    |
    | If you want to verify credentials using the password_verify function or
    | plain text.
    |
    | Supported: "password", "plain"
    |
    */

    'auth' => 'password',

    /*
    |--------------------------------------------------------------------------
    | HTTP Basic Auth Credentials
    |--------------------------------------------------------------------------
    |
    | The array of users with hashed username and password credentials which are
    | used when logging in with HTTP basic authentication.
    |
    */

    'users' => [
        'default' => [
            env('SHIELD_USER'),
            env('SHIELD_PASSWORD'),
        ],
    ],

];
