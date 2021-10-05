<?php

declare(strict_types=1);

namespace DDD\Domain\Entities\Customer;

use DDD\Domain\ValueObject\Phone;

final class Customer implements CustomerInterface
{
    public const TABLE_NAME = 'customer';

    public function __construct(
        private Phone $phone,
    ) {
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function jsonSerialize()
    {
        return [
            'phone' => $this->getPhone(),
        ];
    }
}
