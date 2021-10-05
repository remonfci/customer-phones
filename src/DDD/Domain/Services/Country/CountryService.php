<?php

declare(strict_types=1);

namespace DDD\Domain\Services\Country;

use DDD\Domain\Factories\CountryFactory;

final class CountryService implements CountryServiceInterface
{
    public function findAll(): array
    {
        return CountryFactory::createCountries();
    }
}
