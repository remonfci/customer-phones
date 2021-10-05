<?php

declare(strict_types=1);

namespace DDD\Domain\Services\Customer;

use Application\Helpers\CountryCodeExtractorHelper;
use DDD\Domain\Entities\Customer\Customer;
use DDD\Domain\Exceptions\NotFoundCountryCodeException;
use DDD\Domain\Factories\CountryFactory;
use DDD\Domain\ValueObject\Filter\CustomerFilter;
use DDD\Domain\ValueObject\Paging;
use DDD\Domain\ValueObject\Phone;
use DDD\Infrastructure\Repositories\CustomerRepository;

final class CustomerService implements CustomerServiceInterface
{
    public function __construct(private CustomerRepository $repository)
    {
    }

    public function findAll(CustomerFilter $filter, Paging $paging): array
    {
        $customers = [];

        $data = $this->repository->getAll($filter, $paging);

        foreach ($data as $stringPhoneNumber) {
            try {
                $code = CountryCodeExtractorHelper::getCode($stringPhoneNumber);

                $customers[] = new Customer(
                    phone: new Phone(
                        country: CountryFactory::createCountryFromCode($code),
                        number: $stringPhoneNumber,
                    ),
                );
            } catch (NotFoundCountryCodeException $notFoundCountryCodeException) {
            }
        }

        if (! $filter->hasState()) {
            return $customers;
        }

        return $this->filterCustomersByPhoneState($customers, $filter);
    }

    /**
     * @param  array<int, Customer> $customers
     * @return Customer[]
     */
    private function filterCustomersByPhoneState(array $customers, CustomerFilter $filter): array
    {
        $allCustomers = [];

        foreach ($customers as $customer) {
            if ($filter->isValidState() && $customer->getPhone()->isValid()) {
                $allCustomers[] = $customer;
            } elseif ($filter->isInvalidState() && ! $customer->getPhone()->isValid()) {
                $allCustomers[] = $customer;
            }
        }

        return $allCustomers;
    }
}
