<?php

declare(strict_types=1);

namespace DDD\Domain\Exceptions;

use Throwable;

final class InvalidPhoneNumberException extends \Exception
{
    public function __construct(string $message = 'Phone number is invalid!', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
