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

namespace Vinkla\Tests\Shield;

use Orchestra\Testbench\TestCase;
use Vinkla\Shield\ShieldServiceProvider;

abstract class AbstractTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ShieldServiceProvider::class
        ];
    }

    protected function getUsers()
    {
        return [
            'default' => [
                password_hash('user1', PASSWORD_DEFAULT, ['cost' => 4]),
                password_hash('password1', PASSWORD_DEFAULT, ['cost' => 4]),
            ],
            'hasselhoff' => [
                password_hash('user2', PASSWORD_DEFAULT, ['cost' => 4]),
                password_hash('password2', PASSWORD_DEFAULT, ['cost' => 4]),
            ],
        ];
    }
}
