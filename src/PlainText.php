<?php

declare(strict_types=1);

namespace Vinkla\Shield;

final class PlainText implements Auth
{
    public function verify(string|null $value, string|null $input): bool
    {
        return $value === $input;
    }
}
