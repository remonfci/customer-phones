<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject\Country;

use DDD\Domain\ValueObject\Country\Contracts\Country;

final class Uganda extends Country
{
    public function __construct()
    {
        $this->code = 256;
        $this->name = 'Uganda';
        $this->regex = '/\(256\)\ ?\d{9}$/';
    }
}
