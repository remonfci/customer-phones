<?php

declare(strict_types=1);

namespace Unit\DDD\Domain\Services\Country;

use DDD\Domain\Services\Country\CountryService;
use DDD\Domain\ValueObject\Country\Cameroon;
use DDD\Domain\ValueObject\Country\Uganda;
use PHPUnit\Framework\TestCase as BaseTestCase;

class CountryServiceTest extends BaseTestCase
{
    public function testFindAll(): void
    {
        $countryService = new CountryService();
        $countriesArray = $countryService->findAll();
        $this->assertCount(5, $countriesArray);
        $this->assertEquals(new Cameroon(), $countriesArray[0]);
        $this->assertEquals(new Uganda(), end($countriesArray));
    }
}
