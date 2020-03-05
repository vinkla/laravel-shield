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

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Vinkla\Shield\Shield;
use Vinkla\Shield\ShieldMiddleware;

class ShieldMiddlewareTest extends AbstractTestCase
{
    public function testMiddleware()
    {
        $request = $this->getRequest('user1', 'password1');
        $middleware = $this->getMiddleware();
        $return = $middleware->handle($request, function () {
            //
        });
        $this->assertNull($return);
    }

    public function testMiddlewareWithUser()
    {
        $request = $this->getRequest('user2', 'password2');
        $middleware = $this->getMiddleware();
        $return = $middleware->handle($request, function () {
            //
        }, 'hasselhoff');
        $this->assertNull($return);
    }

    public function testInvalidShieldCredentialsException()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $request = $this->getRequest('user3', 'password3');
        $middleware = $this->getMiddleware();
        $middleware->handle($request, function () {
            //
        });
    }

    public function testInvalidShieldCredentialsExceptionWithUser()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $request = $this->getRequest('user1', 'password1');
        $middleware = $this->getMiddleware();
        $middleware->handle($request, function () {
            //
        }, 'hasselhoff');
    }

    protected function getMiddleware()
    {
        return new ShieldMiddleware(new Shield($this->getUsers()));
    }

    protected function getRequest($user, $password)
    {
        return Request::create('http://localhost', 'GET', [], [], [], ['PHP_AUTH_USER' => $user, 'PHP_AUTH_PW' => $password]);
    }
}
