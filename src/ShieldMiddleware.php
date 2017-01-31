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

namespace Vinkla\Shield;

use Closure;

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
    protected $shield;

    /**
     * Create a new shield middleware class.
     *
     * @param \Vinkla\Shield\Shield $shield
     *
     * @return void
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
     * @return mixed
     */
    public function handle($request, Closure $next, string $user = null)
    {
        $this->shield->verify($request->getUser() ?: '', $request->getPassword() ?: '', $user);

        return $next($request);
    }
}
