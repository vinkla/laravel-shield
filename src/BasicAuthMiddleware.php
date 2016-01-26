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
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Response;

/**
 * This is the basic auth middleware class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class BasicAuthMiddleware
{
    /**
     * The config repository.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    private $config;

    /**
     * Create a new basic auth middleware instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     *
     * @return void
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->config->get('shield.user');
        $password = $this->config->get('shield.password');

        if ($request->getUser() !== $user || $request->getPassword() !== $password) {
            return new Response('Invalid credentials.', 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}
