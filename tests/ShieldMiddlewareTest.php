<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Shield;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Vinkla\Shield\Shield;
use Vinkla\Shield\ShieldMiddleware;

/**
 * This is the shield middleware test class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class ShieldMiddlewareTest extends AbstractTestCase
{
    public function testStandard()
    {
        $request = $this->getRequest(['PHP_AUTH_USER' => 'user1', 'PHP_AUTH_PW' => 'password1']);
        $middleware = $this->getMiddleware();
        $return = $middleware->handle($request, function () {
            //
        });
        $this->assertNull($return);
    }

    public function testStandardWithUser()
    {
        $request = $this->getRequest(['PHP_AUTH_USER' => 'user2', 'PHP_AUTH_PW' => 'password2']);
        $middleware = $this->getMiddleware();
        $return = $middleware->handle($request, function () {
            //
        }, 'alternative');
        $this->assertNull($return);
    }

    public function testInvalidShieldCredentialsException()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $request = $this->getRequest(['PHP_AUTH_USER' => 'user3', 'PHP_AUTH_PW' => 'password3']);
        $middleware = $this->getMiddleware();
        $middleware->handle($request, function () {
            //
        });
    }

    public function testInvalidShieldCredentialsExceptionWithUser()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $request = $this->getRequest(['PHP_AUTH_USER' => 'user1', 'PHP_AUTH_PW' => 'password1']);
        $middleware = $this->getMiddleware();
        $middleware->handle($request, function () {
            //
        }, 'alternative');
    }

    public function getMiddleware()
    {
        $shield = new Shield([
            'main' => [password_hash('user1', PASSWORD_BCRYPT), password_hash('password1', PASSWORD_BCRYPT)],
            'alternative' => [password_hash('user2', PASSWORD_BCRYPT), password_hash('password2', PASSWORD_BCRYPT)],
        ]);

        return new ShieldMiddleware($shield);
    }

    public function getRequest($server)
    {
        return Request::create('http://localhost', 'GET', [], [], [], $server);
    }
}
