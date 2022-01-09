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

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Vinkla\Shield\ShieldServiceProvider;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    protected function getServiceProviderClass()
    {
        return ShieldServiceProvider::class;
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
