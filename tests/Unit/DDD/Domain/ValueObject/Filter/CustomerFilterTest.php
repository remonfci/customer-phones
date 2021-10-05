<?php

declare(strict_types=1);

namespace Unit\DDD\Domain\ValueObject\Filter;

use DDD\Domain\ValueObject\Filter\CustomerFilter;
use PHPUnit\Framework\TestCase as BaseTestCase;

class CustomerFilterTest extends BaseTestCase
{
    public function testHasStateWillReturnFalse(): void
    {
        $customerFilter = new CustomerFilter(237);
        $this->assertEquals(false, $customerFilter->hasState());
    }

    public function testHasStateWillReturnTrue(): void
    {
        $customerFilter = new CustomerFilter(237, 1);
        $this->assertEquals(true, $customerFilter->hasState());
    }

    public function testIsValidStateWillReturnTrue(): void
    {
        $customerFilter = new CustomerFilter(237, 1);
        $this->assertEquals(true, $customerFilter->isValidState());
    }

    public function testIsValidStateWillReturnFalse(): void
    {
        $customerFilter = new CustomerFilter(237, 0);
        $this->assertEquals(false, $customerFilter->isValidState());
    }

    public function testIsInvalidStateWillReturnTrue(): void
    {
        $customerFilter = new CustomerFilter(237, 0);
        $this->assertEquals(true, $customerFilter->isInvalidState());
    }

    public function testIsInvalidStateWillReturnFalse(): void
    {
        $customerFilter = new CustomerFilter(237, 1);
        $this->assertEquals(false, $customerFilter->isInvalidState());
    }

    public function testGetState(): void
    {
        $customerFilter = new CustomerFilter(237, 1);
        $this->assertEquals(1, $customerFilter->getState());
    }

    public function testGetCountryCode(): void
    {
        $customerFilter = new CustomerFilter(295, 1);
        $this->assertEquals(295, $customerFilter->getCountryCode());
    }
}
