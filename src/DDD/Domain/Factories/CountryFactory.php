<?php

declare(strict_types=1);

namespace DDD\Domain\Factories;

use DDD\Domain\Exceptions\NotFoundCountryCodeException;
use DDD\Domain\ValueObject\Country\Cameroon;
use DDD\Domain\ValueObject\Country\Contracts\Country as CountryValueObject;
use DDD\Domain\ValueObject\Country\Ethiopia;
use DDD\Domain\ValueObject\Country\Morocco;
use DDD\Domain\ValueObject\Country\Mozambique;
use DDD\Domain\ValueObject\Country\Uganda;

final class CountryFactory
{
    public static function createCountryFromCode(int $code): CountryValueObject
    {
        return match ($code) {
            237 => new Cameroon(),
            251 => new Ethiopia(),
            212 => new Morocco(),
            258 => new Mozambique(),
            256 => new Uganda(),
            default => throw new NotFoundCountryCodeException(),
        };
    }

    /**
     * @return CountryValueObject[]
     */
    public static function createCountries(): array
    {
        return [
            new Cameroon(),
            new Ethiopia(),
            new Morocco(),
            new Mozambique(),
            new Uganda(),
        ];
    }
}
