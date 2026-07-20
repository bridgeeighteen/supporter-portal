<?php

return [
    'database_type' => 'mysql',
    'database_name' => $_ENV['DB_NAME'] ?? 'becsp',
    'server'        => $_ENV['DB_HOST'] ?? 'localhost',
    'username'      => $_ENV['DB_USER'] ?? 'root',
    'password'      => $_ENV['DB_PASS'] ?? '',
    'charset'       => 'utf8mb4',
    'collation'     => 'utf8mb4_unicode_ci',
    'port'          => 3306,
    'option'        => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];
