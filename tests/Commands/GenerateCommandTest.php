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

use Mockery;
use Vinkla\Tests\Shield\AbstractTestCase;

/**
 * This is the generate command test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GenerateCommandTest extends AbstractTestCase
{
    public function testGenerate()
    {
        $this->artisan('shield:generate', [
            'user' => 'test',
            'username' => 'user1',
            'password' => 'password1',
        ]);

    }
}
