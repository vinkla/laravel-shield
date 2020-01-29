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

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Vinkla\Shield\Shield;
use Vinkla\Shield\ShieldMiddleware;

class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testShieldIsInjectable()
    {
        $this->assertIsInjectable(Shield::class);
    }

    public function testShieldMiddlewareIsInjectable()
    {
        $this->assertIsInjectable(ShieldMiddleware::class);
    }
}
