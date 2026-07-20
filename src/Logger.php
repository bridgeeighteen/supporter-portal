<?php

namespace BECSP;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

class Logger
{
    private static ?MonologLogger $appLogger = null;
    private static ?MonologLogger $accessLogger = null;

    public static function app(): MonologLogger
    {
        if (self::$appLogger === null) {
            self::$appLogger = new MonologLogger('app');

            $logPath = dirname(__DIR__) . '/logs/app.log';
            $level = self::getLogLevel();

            self::$appLogger->pushHandler(new RotatingFileHandler($logPath, 30, $level));

            if (!Config::isProduction()) {
                self::$appLogger->pushHandler(new StreamHandler('php://stderr', Level::Debug));
            }
        }

        return self::$appLogger;
    }

    public static function access(): MonologLogger
    {
        if (self::$accessLogger === null) {
            self::$accessLogger = new MonologLogger('access');

            $logPath = dirname(__DIR__) . '/logs/access.log';
            $level = self::getLogLevel();

            self::$accessLogger->pushHandler(new RotatingFileHandler($logPath, 30, $level));
        }

        return self::$accessLogger;
    }

    private static function getLogLevel(): Level
    {
        $level = strtolower($_ENV['LOG_LEVEL'] ?? 'info');

        return match ($level) {
            'debug'     => Level::Debug,
            'notice'    => Level::Notice,
            'warning'   => Level::Warning,
            'error'     => Level::Error,
            'critical'  => Level::Critical,
            'alert'     => Level::Alert,
            'emergency' => Level::Emergency,
            default     => Level::Info,
        };
    }
}
