<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject\Country\Contracts;

use JsonSerializable;

abstract class Country implements JsonSerializable
{
    protected int $code;
    protected string $name;
    protected string $regex;

    public function getCode(): string
    {
        return '+' . $this->code;
    }

    public function getPhoneRegex(): string
    {
        return $this->regex;
    }

    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'regex' => $this->regex,
        ];
    }
}
