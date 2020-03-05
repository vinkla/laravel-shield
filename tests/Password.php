<?php

declare(strict_types=1);

namespace Vinkla\Tests\Shield;

class Password
{
    public static function hash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
    }
}
