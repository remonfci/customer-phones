<?php

declare(strict_types=1);

return [
    'default' => 'sqlite',

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', storage_path('/../database/sample.db')),
        ],
    ],
];
