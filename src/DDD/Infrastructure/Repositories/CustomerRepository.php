<?php

declare(strict_types=1);

namespace DDD\Infrastructure\Repositories;

use DDD\Domain\ValueObject\Filter\CustomerFilter;
use DDD\Domain\ValueObject\Paging;

interface CustomerRepository
{
    /**
     * @return array<int, string>
     */
    public function getAll(CustomerFilter $filter, Paging $paging): array;
}
