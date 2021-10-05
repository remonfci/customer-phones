<?php

declare(strict_types=1);

namespace Functional;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

class WebTestCase extends BaseTestCase
{
    public function createApplication()
    {
        return require __DIR__ . '/../../bootstrap/app.php';
    }
}
