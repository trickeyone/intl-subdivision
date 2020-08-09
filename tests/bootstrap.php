<?php

namespace Symfony\Component\IntlSubdivision;

use Exception;

class PHPUnitBootstrap
{
    public static function init()
    {
        ini_set('display_errors', '1');
        error_reporting(E_ALL);
        date_default_timezone_set('UTC');

        try {
            self::includePHPUnitIfNeeded();
        } catch (Exception $err) {
            self::printMessage($err->getMessage());
            exit(1);
        }
    }

    protected static function includePHPUnitIfNeeded()
    {
        if (!isset($_SERVER['IDE_PHPUNIT_CUSTOM_LOADER'])) {
            require_once __DIR__ . DIRECTORY_SEPARATOR . '/../vendor/autoload.php';
        }
    }

    /**
     * @param string $message
     */
    protected static function printMessage($message)
    {
        print $message . PHP_EOL;
    }
}

PHPUnitBootstrap::init();
