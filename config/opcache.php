<?php

return [
    'url' => env('OPCACHE_URL', config('app.url')),
    'prefix' => 'opcache-api',
    'verify' => true,
    'headers' => [],
    'verify_ssl' => env('APP_ENV') === 'production',
    'directories' => [
        base_path('app'),
        base_path('bootstrap'),
        base_path('public'),
        base_path('resources'),
        base_path('routes'),
        base_path('storage'),
        base_path('vendor'),
    ],
    'exclude' => [
        'test',
        'Test',
        'tests',
        'Tests',
        'stub',
        'Stub',
        'stubs',
        'Stubs',
        'dumper',
        'Dumper',
    ],
];
