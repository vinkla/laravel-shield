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

namespace Vinkla\Shield;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Shield
{
    protected array $users;

    protected string $currentUser;

    public function __construct(array $users = [])
    {
        $this->users = $users;
    }

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     * @return null
     */
    public function verify(string $username, string $password, ?string $user = null)
    {
        if ($username && $password) {
            $users = $this->getUsers($user);

            foreach ($users as $user => $credentials) {
                if (
                    password_verify($username, reset($credentials)) &&
                    password_verify($password, end($credentials))
                ) {
                    $this->currentUser = $user;

                    return;
                }
            }
        }

        throw new UnauthorizedHttpException('Basic');
    }

    protected function getUsers(string $user = null): array
    {
        if ($user !== null) {
            return array_intersect_key($this->users, array_flip((array) $user));
        }

        return $this->users;
    }

    public function getCurrentUser(): string
    {
        return $this->currentUser;
    }
}
