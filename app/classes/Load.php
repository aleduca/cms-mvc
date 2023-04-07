<?php

namespace app\classes;

class Load
{
    public static $config;

    public static function load($index)
    {
        static::$config = require '../config.php';

        if (!isset(static::$config[$index])) {
            throw new \Exception("Esse índice nãoo existe: {$index}, no classe Load");
        }

        return (object) static::$config[$index];
    }
}
