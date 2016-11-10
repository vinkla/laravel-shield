<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Shield\Commands;

use Vinkla\Tests\Shield\AbstractTestCase;

/**
 * This is the hash command test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HashCommandTest extends AbstractTestCase
{
    public function testStandard()
    {
        $return = $this->artisan('shield:hash', ['credentials' => ['hash1', 'hash2']]);
        $this->assertSame(0, $return);
    }

    /**
     * @expectedException \Symfony\Component\Console\Exception\RuntimeException
     */
    public function testWithoutCredentials()
    {
        $this->artisan('shield:hash', []);
    }
}
