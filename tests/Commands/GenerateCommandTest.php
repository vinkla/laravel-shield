<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Shield\Commands;

use Vinkla\Tests\Shield\AbstractTestCase;

/**
 * This is the generate command test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GenerateCommandTest extends AbstractTestCase
{
    public function testStandard()
    {
        $return = $this->artisan('shield:generate', ['user' => 'user1', 'password' => 'password1']);
        $this->assertSame(0, $return);
    }

    /**
     * @expectedException \Symfony\Component\Console\Exception\RuntimeException
     */
    public function testWithoutUser()
    {
        $this->artisan('shield:generate', ['password' => 'password1']);
    }

    /**
     * @expectedException \Symfony\Component\Console\Exception\RuntimeException
     */
    public function testWithoutPassword()
    {
        $this->artisan('shield:generate', ['user' => 'user1']);
    }
}
