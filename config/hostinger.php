<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Hostinger Specific Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration options specific to Hostinger hosting environment
    |
    */

    'hostinger' => [
        'enabled' => env('HOSTINGER_CONFIG', true),
        
        // Hostinger typically uses these settings
        'database' => [
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'strict' => true,
            'engine' => null,
        ],
        
        // Session configuration for shared hosting
        'session' => [
            'driver' => 'database',
            'lifetime' => 120,
            'encrypt' => false,
            'files' => storage_path('framework/sessions'),
            'connection' => null,
            'table' => 'sessions',
            'store' => null,
            'lottery' => [2, 100],
            'cookie' => env('SESSION_COOKIE', 'artline_session'),
            'path' => '/',
            'domain' => env('SESSION_DOMAIN', null),
            'secure' => env('SESSION_SECURE_COOKIE', true),
            'http_only' => true,
            'same_site' => 'lax',
        ],
        
        // Cache configuration
        'cache' => [
            'default' => 'database',
            'stores' => [
                'database' => [
                    'driver' => 'database',
                    'table' => 'cache',
                    'connection' => null,
                ],
            ],
        ],
        
        // Mail configuration for Hostinger
        'mail' => [
            'default' => 'smtp',
            'mailers' => [
                'smtp' => [
                    'transport' => 'smtp',
                    'host' => env('MAIL_HOST', 'smtp.hostinger.com'),
                    'port' => env('MAIL_PORT', 587),
                    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
                    'username' => env('MAIL_USERNAME'),
                    'password' => env('MAIL_PASSWORD'),
                    'timeout' => null,
                ],
            ],
        ],
    ],
];
