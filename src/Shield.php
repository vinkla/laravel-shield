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
     * Validate the incoming request.
     *
     * @param string $username
     * @param string $password
     * @param string|null $user
     *
     * @throws \Vinkla\Shield\Exceptions\UnauthorizedShieldException
     *
     * @return null|void
     */
    public function validate($username, $password, $user = null)
    {
        $users = $this->getUsers($user);

        foreach ($users as $credentials) {
            $username = password_verify($username, reset($credentials));
            $password = password_verify($password, end($credentials));

            if ($username && $password) {
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
}
