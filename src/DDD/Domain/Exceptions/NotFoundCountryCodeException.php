<?php

declare(strict_types=1);

namespace DDD\Domain\Exceptions;

final class NotFoundCountryCodeException extends \Exception
{
    public function __construct(string $message = 'Invalid country code!', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
