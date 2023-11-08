<?php

/**
 * Copyright (c) Vincent Klaiber
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-shield
 */

declare(strict_types=1);

namespace Vinkla\Tests\Shield;

use ReflectionClass;
use Vinkla\Shield\Shield;

class ShieldTest extends AbstractTestCase
{
    public function testVerify()
    {
        $shield = $this->getShield();
        $this->assertTrue($shield->verify('user1', 'password1'));
        $this->assertTrue($shield->verify('user2', 'password2'));
    }

    public function testVerifyWithUser()
    {
        $shield = $this->getShield();
        $this->assertTrue($shield->verify('user2', 'password2', 'hasselhoff'));
    }

    public function testGetCurrentUser()
    {
        $shield = $this->getShield();

        $this->assertTrue($shield->verify('user1', 'password1'));
        $this->assertSame('default', $shield->getCurrentUser());

        $this->assertTrue($shield->verify('user2', 'password2'));
        $this->assertSame('hasselhoff', $shield->getCurrentUser());
    }

    public function testUnauthorizedUser()
    {
        $shield = $this->getShield();
        $this->assertFalse($shield->verify('user3', 'password3'));
    }

    public function testUnauthorizedUserWithNullableCredentials()
    {
        $shield = $this->getShield();
        $this->assertFalse($shield->verify(null, null));
    }

    public function testUnauthorizedWithUser()
    {
        $shield = $this->getShield();
        $this->assertFalse($shield->verify('user1', 'password1', 'hasselhoff'));
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

    protected function getShield()
    {
        return new Shield($this->getUsers());
    }
}
