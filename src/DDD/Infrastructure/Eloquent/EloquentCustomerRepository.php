<?php

declare(strict_types=1);

namespace DDD\Infrastructure\Eloquent;

use DDD\Domain\Entities\Customer\Customer;
use DDD\Domain\ValueObject\Filter\CustomerFilter;
use DDD\Domain\ValueObject\Paging;
use DDD\Infrastructure\Repositories\CustomerRepository;
use Illuminate\Support\Facades\DB;

final class EloquentCustomerRepository implements CustomerRepository
{
    public function getAll(CustomerFilter $filter, Paging $paging): array
    {
        $limit = $paging->getLimit();
        $offset = $paging->getPage() <= 0 ? 0 : ($paging->getPage() - 1) * $limit;

        $query = DB::table(Customer::TABLE_NAME);

        if ($filter->getCountryCode()) {
            $query->where('phone', 'LIKE', '(' . $filter->getCountryCode() . ')%');
        }

        $query->orderBy('id', 'ASC');

        if (! $filter->hasState()) {
            $query->skip($offset)->take($limit);
        }

        return $query->pluck('phone')->toArray();
    }
}
