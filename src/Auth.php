<?php

declare(strict_types=1);

namespace Vinkla\Shield;

interface Auth
{
    public function verify(string|null $value, string|null $input): bool;
}
