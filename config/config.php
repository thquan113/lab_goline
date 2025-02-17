<?php

return [
    'base_url' => 'http://quanth.id.vn/',
    'db' => [
        'host' => $_ENV['DB_HOST'],
        'user' => $_ENV['DB_USERNAME'],
        'pass' => $_ENV['DB_PASSWORD'],
        'name' => $_ENV['DB_DATABASE'],
    ]
];
