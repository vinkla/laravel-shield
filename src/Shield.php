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

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * This is the shield class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Shield
{
    /**
     * The users array.
     *
     * @var array
     */
    protected $users;

    /**
     * The authenticated user.
     *
     * @var string
     */
    protected $currentUser;

    /**
     * Create a new shield instance.
     *
     * @param array $users
     *
     * @return void
     */
    public function __construct(array $users = [])
    {
        $this->users = $users;
    }

    /**
     * Verify the user input.
     *
     * @param string $username
     * @param string $password
     * @param string|null $user
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     *
     * @return null
     */
    public function verify(string $username, string $password, string $user = null)
    {
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

        throw new UnauthorizedHttpException('Basic');
    }

    /**
     * Get the user credentials array.
     *
     * @param string|null $user
     *
     * @return array
     */
    protected function getUsers(string $user = null): array
    {
        if ($user !== null) {
            return array_intersect_key($this->users, array_flip((array) $user));
        }

        return $this->users;
    }

    /**
     * Get the current authenticated use.
     *
     * @return string
     */
    public function getCurrentUser(): string
    {
        return $this->currentUser;
    }
}
