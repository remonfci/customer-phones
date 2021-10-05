<?php

declare(strict_types=1);

namespace Unit\DDD\Domain\ValueObject;

use DDD\Domain\ValueObject\Country\Ethiopia;
use DDD\Domain\ValueObject\Phone;
use PHPUnit\Framework\TestCase as BaseTestCase;

class PhoneTest extends BaseTestCase
{
    public function testGetCountry(): void
    {
        $country = new Ethiopia();
        $phone = new Phone($country, '(237) 4210221');

        $this->assertEquals($phone->getCountry(), new Ethiopia());
    }

    public function testIsValidWithInvalidPhoneNumber(): void
    {
        $country = new Ethiopia();
        $phone = new Phone($country, '(237) 4210221');

        $this->assertEquals(false, $phone->isValid());
    }

    public function testIsValidWithValidPhoneNumber(): void
    {
        $country = new Ethiopia();
        $phone = new Phone($country, '(251) 966002259');

        $this->assertEquals(true, $phone->isValid());
    }

    public function testGetNumber(): void
    {
        $country = new Ethiopia();
        $phone = new Phone($country, '(251) 966002259');

        $this->assertEquals('966002259', $phone->getNumber());
    }
}
