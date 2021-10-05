<?php

declare(strict_types=1);

namespace Unit\DDD\Domain\Services\Customer;

use DDD\Domain\Services\Customer\CustomerService;
use DDD\Domain\ValueObject\Country\Cameroon;
use DDD\Domain\ValueObject\Country\Ethiopia;
use DDD\Domain\ValueObject\Country\Mozambique;
use DDD\Domain\ValueObject\Filter\CustomerFilter;
use DDD\Domain\ValueObject\Paging;
use DDD\Infrastructure\Repositories\CustomerRepository;
use PHPUnit\Framework\TestCase as BaseTestCase;

class CustomerServiceTest extends BaseTestCase
{
    public function testFindAll(): void
    {
        $customerRepository = $this->getMockBuilder(CustomerRepository::class)->getMock();
        $customerRepository->expects($this->any())->method('getAll')->willReturn(
            ['(237) 4210221', '(251) 4210221', '(258) 4210221'],
        );

        $customerFilter = new CustomerFilter(
            null,
            null
        );
        $paging = $this->getMockBuilder(Paging::class)->getMock();

        $customerService = new CustomerService($customerRepository);
        $result = $customerService->findAll($customerFilter, $paging);
        $this->assertCount(3, $result);
        $this->assertEquals($result[0]->getPhone()->getCountry(), new Cameroon());
        $this->assertEquals($result[2]->getPhone()->getCountry(), new Mozambique());
    }

    public function testFindAllWithValidStateReturnsOnlyValidPhonesWithPagination(): void
    {
        $customerRepository = $this->getMockBuilder(CustomerRepository::class)->getMock();
        $customerRepository->expects($this->any())->method('getAll')->willReturn(
            ['(237) 4210221', '(251) 4210221', '(258) 28345678'],
        );

        $customerFilter = new CustomerFilter(
            null,
            1
        );
        $paging = $this->getMockBuilder(Paging::class)->getMock();

        $customerService = new CustomerService($customerRepository);
        $result = $customerService->findAll($customerFilter, $paging);
        $this->assertCount(1, $result);
        $this->assertEquals($result[0]->getPhone()->getCountry(), new Mozambique());
    }

    public function testFindAllWithInvalidStateReturnsOnlyInValidPhonesWithPagination(): void
    {
        $customerRepository = $this->getMockBuilder(CustomerRepository::class)->getMock();
        $customerRepository->expects($this->any())->method('getAll')->willReturn(
            ['(237) 4210221', '(251) 4210221', '(258) 28345678'],
        );

        $customerFilter = new CustomerFilter(
            null,
            0
        );
        $paging = $this->getMockBuilder(Paging::class)->getMock();

        $customerService = new CustomerService($customerRepository);
        $result = $customerService->findAll($customerFilter, $paging);
        $this->assertCount(2, $result);
        $this->assertEquals($result[0]->getPhone()->getCountry(), new Cameroon());
        $this->assertEquals($result[1]->getPhone()->getCountry(), new Ethiopia());
    }

    public function testFindPhonesForSpecificCountryWithPagination(): void
    {
        $customerRepository = $this->getMockBuilder(CustomerRepository::class)->getMock();
        $customerRepository->expects($this->any())->method('getAll')->willReturn(
            ['(251) 4210221'],
        );

        $customerFilter = new CustomerFilter(
            251,
            0
        );
        $paging = $this->getMockBuilder(Paging::class)->getMock();

        $customerService = new CustomerService($customerRepository);
        $result = $customerService->findAll($customerFilter, $paging);
        $this->assertCount(1, $result);
        $this->assertEquals($result[0]->getPhone()->getCountry(), new Ethiopia());
    }
}
