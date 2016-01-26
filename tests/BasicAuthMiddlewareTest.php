<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Shield;

use Illuminate\Http\Request;
use Vinkla\Shield\BasicAuthMiddleware;

/**
 * This is the basic auth middleware test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BasicAuthMiddlewareTest extends AbstractTestCase
{
    public function testStandard()
    {
        $request = $this->getRequest([
            'PHP_AUTH_PW' => 'your-password',
            'PHP_AUTH_USER' => 'your-username',
        ]);

        $middleware = $this->getMiddleware();

        $return = $middleware->handle($request, function () { });

        $this->assertNull($return);
    }

    public function testStandardWithoutUser()
    {
        $request = $this->getRequest(['PHP_AUTH_PW' => 'your-password']);

        $middleware = $this->getMiddleware();

        $return = $middleware->handle($request, function () { });

        $this->assertSame(401, $return->getStatusCode());
    }

    public function testStandardWithoutPassword()
    {
        $request = $this->getRequest(['PHP_AUTH_USER' => 'your-username']);

        $middleware = $this->getMiddleware();

        $return = $middleware->handle($request, function () { });

        $this->assertSame(401, $return->getStatusCode());
    }

    public function getMiddleware()
    {
        return new BasicAuthMiddleware($this->app->config);
    }

    public function getRequest($server)
    {
        return Request::create('http://localhost', 'GET', [], [], [], $server);
    }
}
