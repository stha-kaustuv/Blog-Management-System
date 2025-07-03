<?php


return [
    'paths' => [
        'api/*',
        'sanctum/csrf-cookie',
        '*', // Allow all routes for development
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:8080', // Your frontend URL
        'http://127.0.0.1:8080', // Alternative localhost
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [
        'Authorization',
        'X-Requested-With',
    ],

    'max_age' => 86400, // 24 hours for preflight cache

    'supports_credentials' => true, // Enable if using cookies/auth
];
