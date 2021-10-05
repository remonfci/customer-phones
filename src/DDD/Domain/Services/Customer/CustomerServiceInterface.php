<?php

declare(strict_types=1);

namespace DDD\Domain\Services\Customer;

use DDD\Domain\Entities\Customer\Customer;
use DDD\Domain\ValueObject\Filter\CustomerFilter;
use DDD\Domain\ValueObject\Paging;

interface CustomerServiceInterface
{
    /**
     * @return Customer[]
     */
    public function findAll(CustomerFilter $filter, Paging $paging): array;
}
