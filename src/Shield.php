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

use Vinkla\Shield\Exceptions\UnauthorizedShieldException;

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
     * @throws \Vinkla\Shield\Exceptions\UnauthorizedShieldException
     *
     * @return null|void
     */
    public function verify($username, $password, $user = null)
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

        throw new UnauthorizedShieldException();
    }

    /**
     * Get the user credentials array.
     *
     * @param string|null $user
     *
     * @return array
     */
    protected function getUsers($user = null)
    {
        if ($user !== null) {
            return array_only($this->users, $user);
        }

        return $this->users;
    }

    /**
     * Get the current authenticated use.
     *
     * @return array $currentUser attribute
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }
}
