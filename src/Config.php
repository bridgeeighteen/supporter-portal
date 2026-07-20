<?php

namespace BECSP;

use Dotenv\Dotenv;

class Config
{
    private static ?array $appConfig = null;

    public static function load(string $rootPath): void
    {
        $dotenv = Dotenv::createImmutable($rootPath);
        $dotenv->safeLoad();

        self::$appConfig = require $rootPath . '/config/app.php';
    }

    public static function get(string $key, $default = null)
    {
        return self::$appConfig[$key] ?? $_ENV[$key] ?? $default;
    }

    public static function all(): array
    {
        return self::$appConfig ?? [];
    }

    public static function isProduction(): bool
    {
        return ($_ENV['APP_ENV'] ?? 'production') === 'production';
    }

    public static function siteUrl(): string
    {
        return rtrim((string) self::get('SITE_URL', ''), '/');
    }
}
