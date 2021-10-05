<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject\Country;

use DDD\Domain\ValueObject\Country\Contracts\Country;

final class Morocco extends Country
{
    public function __construct()
    {
        $this->code = 212;
        $this->name = 'Morocco';
        $this->regex = '/\(212\)\ ?[5-9]\d{8}$/';
    }
}
