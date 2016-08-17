<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | HTTP Basic Auth Credentials
    |--------------------------------------------------------------------------
    |
    | The user credentials which are used when logging in with HTTP basic
    | authentication. You can hash new user credentials by running the artisan
    | command shield:hash.
    |
    */

    'users' => [
        'main' => empty(env('SHIELD_USER')) ? null : explode(':', str_replace(' ', '', env('SHIELD_USER'))),
    ],

];
