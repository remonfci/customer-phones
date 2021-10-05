<?php

declare(strict_types=1);

namespace DDD\Domain\Services\Country;

use DDD\Domain\ValueObject\Country\Contracts\Country;

interface CountryServiceInterface
{
    /**
     * @return Country[]
     */
    public function findAll(): array;
}
