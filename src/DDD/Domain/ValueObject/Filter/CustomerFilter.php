<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject\Filter;

class CustomerFilter
{
    public const INVALID_STATE = 0;
    public const VALID_STATE = 1;

    public function __construct(
        private ?int $countryCode = null,
        private ?int $state = null,
    ) {
    }

    /**
     * @return array<string, null|int>
     */
    public function __toArray(): array
    {
        return [
            'countryCode' => $this->countryCode,
            'state' => $this->state,
        ];
    }

    public function getCountryCode(): ?int
    {
        return $this->countryCode;
    }

    public function hasState(): bool
    {
        return $this->isInvalidState() || $this->isValidState();
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function isValidState(): bool
    {
        return $this->state === self::VALID_STATE;
    }

    public function isInvalidState(): bool
    {
        return $this->state === self::INVALID_STATE;
    }
}
