<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject\Country\Contracts;

interface CountryInterface
{
    public function getCode(): string;

    public function getName(): string;

    public function getPhoneRegex(): string;
}
