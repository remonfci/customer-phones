<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject\Country;

use DDD\Domain\ValueObject\Country\Contracts\Country;

final class Ethiopia extends Country
{
    public function __construct()
    {
        $this->code = 251;
        $this->name = 'Ethiopia';
        $this->regex = '/\(251\)\ ?[1-59]\d{8}$/';
    }
}
