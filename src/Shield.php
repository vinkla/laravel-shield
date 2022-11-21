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

class Shield
{
    protected string $currentUser;

    public function __construct(
        protected array $users,
        protected Auth $auth = new PasswordHash()
    ) {
    }

    public function verify(string|null $username, string|null $password, string|null $user = null): bool
    {
        if ($username === null || $password === null) {
            return false;
        }

        $users = $this->getUsers($user);

        foreach ($users as $user => $credentials) {
            if (
                $this->auth->verify($username, $credentials[0]) &&
                $this->auth->verify($password, $credentials[1])
            ) {
                $this->currentUser = $user;

                return true;
            }
        }

        return false;
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
