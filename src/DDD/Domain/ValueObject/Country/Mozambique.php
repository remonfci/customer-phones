<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject\Country;

use DDD\Domain\ValueObject\Country\Contracts\Country;

final class Mozambique extends Country
{
    public function __construct()
    {
        $this->code = 258;
        $this->name = 'Mozambique';
        $this->regex = '/\(258\)\ ?[28]\d{7,8}$/';
    }
}
