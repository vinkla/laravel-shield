<?php

declare(strict_types=1);

namespace Vinkla\Shield;

final class PasswordHash implements Auth
{
    public function verify(string|null $value, string|null $input): bool
    {
        return password_verify($value, $input);
    }
}
