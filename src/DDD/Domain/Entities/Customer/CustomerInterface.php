<?php

declare(strict_types=1);

namespace DDD\Domain\Entities\Customer;

use DDD\Domain\ValueObject\Phone;
use JsonSerializable;

interface CustomerInterface extends JsonSerializable
{
    public function getPhone(): Phone;
}
