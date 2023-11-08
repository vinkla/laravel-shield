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

namespace Vinkla\Shield;

use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ShieldMiddleware
{
    public function __construct(
        protected Shield $shield
    ) {
        //
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     * @return mixed
     */
    public function handle($request, Closure $next, ?string $user = null): mixed
    {
        if ($this->shield->verify($request->getUser(), $request->getPassword(), $user) === false) {
            throw new UnauthorizedHttpException('Basic');
        }

        return $next($request);
    }
}
