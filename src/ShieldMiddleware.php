<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Shield;

use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Vinkla\Shield\Exceptions\UnauthorizedShieldException;

/**
 * This is the shield middleware class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ShieldMiddleware
{
    /**
     * The shield instance.
     *
     * @var \Vinkla\Shield\Shield
     */
    private $shield;

    /**
     * Create a new shield middleware class.
     *
     * @param \Vinkla\Shield\Shield $shield
     */
    public function __construct(Shield $shield)
    {
        $this->shield = $shield;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $user
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $user = null)
    {
        try {
            $this->shield->verify($request->getUser(), $request->getPassword(), $user);
        } catch (UnauthorizedShieldException $e) {
            throw new UnauthorizedHttpException('Basic');
        }

        return $next($request);
    }
}
