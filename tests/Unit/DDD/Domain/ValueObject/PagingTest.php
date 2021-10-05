<?php

declare(strict_types=1);

namespace Unit\DDD\Domain\ValueObject;

use DDD\Domain\ValueObject\Paging;
use PHPUnit\Framework\TestCase as BaseTestCase;

class PagingTest extends BaseTestCase
{
    public function testGetPageAndGetLimitWithoutSendingPageLimit(): void
    {
        $paging = new Paging(1);
        $this->assertEquals(1, $paging->getPage());
        $this->assertEquals(Paging::DEFAULT_LIMIT, $paging->getLimit());
    }

    public function testGetPageAndGetLimitWithoutSendingParamsToConstructor(): void
    {
        $paging = new Paging();
        $this->assertEquals(1, $paging->getPage());
        $this->assertEquals(Paging::DEFAULT_LIMIT, $paging->getLimit());
    }
}
