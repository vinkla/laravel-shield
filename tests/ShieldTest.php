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

use ReflectionClass;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Vinkla\Shield\Shield;

class ShieldTest extends AbstractTestCase
{
    public function testVerify()
    {
        $shield = $this->getShield();
        $this->assertNull($shield->verify('user1', 'password1'));
        $this->assertNull($shield->verify('user2', 'password2'));
    }

    public function testVerifyWithUser()
    {
        $shield = $this->getShield();
        $this->assertNull($shield->verify('user1', 'password1', 'main'));
    }

    public function testGetCurrentUser()
    {
        $shield = $this->getShield();

        $this->assertNull($shield->verify('user1', 'password1'));
        $this->assertSame('main', $shield->getCurrentUser());

        $this->assertNull($shield->verify('user2', 'password2'));
        $this->assertSame('alternative', $shield->getCurrentUser());
    }

    public function testUnauthorizedException()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $shield = $this->getShield();
        $shield->verify('user3', 'password3');
    }

    public function testUnauthorizedExceptionWithoutCredentials()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $shield = $this->getShield();
        $shield->verify(null, null);
    }

    public function testUnauthorizedExceptionWithUser()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $shield = $this->getShield();
        $shield->verify('user1', 'password1', 'alternative');
    }

    public function testGetUsers()
    {
        $rc = new ReflectionClass(Shield::class);
        $method = $rc->getMethod('getUsers');
        $method->setAccessible(true);

        $shield = new Shield([1, 2]);
        $return = $method->invokeArgs($shield, []);
        $this->assertSame(2, count($return));

        $shield = new Shield([1, 2]);
        $return = $method->invokeArgs($shield, [1]);
        $this->assertSame(1, count($return));
    }

    public function getShield()
    {
        return new Shield([
            'main' => [password_hash('user1', PASSWORD_BCRYPT), password_hash('password1', PASSWORD_BCRYPT)],
            'alternative' => [password_hash('user2', PASSWORD_BCRYPT), password_hash('password2', PASSWORD_BCRYPT)],
        ]);
    }
}
