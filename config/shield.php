<?php

return [

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

    /*
    |--------------------------------------------------------------------------
    | Password Driver
    |--------------------------------------------------------------------------
    |
    | If you want to verify hashed credentials using the password_verify
    | function or plain text.
    |
    | Supported: "hash", "plain"
    |
    */

    'driver' => 'hash',

];
