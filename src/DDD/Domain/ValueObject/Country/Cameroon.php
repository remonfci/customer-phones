<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject\Country;

use DDD\Domain\ValueObject\Country\Contracts\Country;

final class Cameroon extends Country
{
    public function __construct()
    {
        $this->code = 237;
        $this->name = 'Cameroon';
        $this->regex = '/\(237\)\ ?[2368]\d{7,8}$/';
    }
}
