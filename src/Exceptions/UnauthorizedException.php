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

namespace Vinkla\Shield\Exceptions;

use RuntimeException;

/**
 * This is the unauthorized exception class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class UnauthorizedException extends RuntimeException implements ShieldExceptionInterface
{
    //
}
