<?php

declare(strict_types=1);

namespace DDD\Domain\ValueObject;

class Paging
{
    public const DEFAULT_LIMIT = 10;

    private int $page;
    private int $limit;

    public function __construct(?int $page = null, ?int $limit = null)
    {
        $this->page = ($page) ?: 1;
        $this->limit = ($limit) ?: self::DEFAULT_LIMIT;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
