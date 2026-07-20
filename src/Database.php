<?php

namespace BECSP;

use Medoo\Medoo;

class Database
{
    private static ?Medoo $instance = null;

    public static function getInstance(): Medoo
    {
        if (self::$instance === null) {
            $config = require dirname(__DIR__) . '/config/database.php';
            self::$instance = new Medoo($config);
        }

        return self::$instance;
    }

    public static function reset(): void
    {
        self::$instance = null;
    }
}
