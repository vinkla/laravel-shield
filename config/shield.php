<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-shield
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | HTTP Basic Auth Credentials
    |--------------------------------------------------------------------------
    |
    | The user credentials which are used when logging in with HTTP basic
    | authentication.
    |
    */

    'users' => [
        'main' => [
            env('SHIELD_USER'),
            env('SHIELD_PASSWORD'),
        ],
    ],

];
