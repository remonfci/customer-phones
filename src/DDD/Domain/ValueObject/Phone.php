<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject;

use DDD\Domain\ValueObject\Country\Contracts\Country;

final class Phone implements \JsonSerializable
{
    private Country $country;
    private string $number;
    private bool $isValid = false;

    public function __construct(Country $country, string $number)
    {
        $this->country = $country;
        $this->number = trim((string) strstr($number, ' '));

        if (preg_match($country->getPhoneRegex(), $number)) {
            $this->isValid = true;
        }
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function jsonSerialize()
    {
        return [
            'number' => $this->number,
            'isValid' => $this->isValid,
            'country' => $this->country,
        ];
    }
}
