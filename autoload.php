<?php

class Autoload
{
    public static function inclusionAuto(string $className)
    {
        require_once __DIR__ . '/' . str_replace('\\', '/', $className . '.php');
    }
}

spl_autoload_register('Autoload::inclusionAuto');
