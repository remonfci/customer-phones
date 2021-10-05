<?php

declare(strict_types=1);

namespace DDD\Domain\Exceptions;

final class InvalidCountryRegexPatternException extends \Exception
{
    public function __construct(string $message = 'Invalid country regex pattern!', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
