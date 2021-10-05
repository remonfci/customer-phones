<?php

declare(strict_types=1);

namespace Unit\DDD\Domain\Factories;

use DDD\Domain\Exceptions\NotFoundCountryCodeException;
use DDD\Domain\Factories\CountryFactory;
use DDD\Domain\ValueObject\Country\Cameroon;
use DDD\Domain\ValueObject\Country\Ethiopia;
use DDD\Domain\ValueObject\Country\Uganda;
use PHPUnit\Framework\TestCase as BaseTestCase;

class CountryFactoryTest extends BaseTestCase
{
    public function testCreateCountryFromCode(): void
    {
        $country = CountryFactory::createCountryFromCode(251);
        $this->assertEquals(new Ethiopia(), $country);
    }

    public function testCreateCountryFromInvalidCodeWillThrowAnException(): void
    {
        $this->expectException(NotFoundCountryCodeException::class);
        CountryFactory::createCountryFromCode(110);
    }

    public function testCreateCountries(): void
    {
        $countriesArray = CountryFactory::createCountries();

        $this->assertCount(5, $countriesArray);
        $this->assertEquals(new Cameroon(), $countriesArray[0]);
        $this->assertEquals(new Uganda(), end($countriesArray));
    }
}
