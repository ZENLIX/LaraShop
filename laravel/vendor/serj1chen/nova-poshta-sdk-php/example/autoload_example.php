<?php

if (!defined('NOVA_POSHTA_EXAMPLE_PATH')) {
    define('NOVA_POSHTA_EXAMPLE_PATH', dirname(__FILE__) . '/');

    AutoloadExample::init();
}

class AutoloadExample
{
    public static function init()
    {
        if (function_exists('__autoload')) {
            spl_autoload_register('__autoload');
        }

        return spl_autoload_register(array('AutoloadExample', 'load'));
    }

    public static function load($className)
    {
        $className = str_replace('NovaPoshta_example', '', $className);
        $className = NOVA_POSHTA_EXAMPLE_PATH . $className . '.php';

        if ((file_exists($className) === false) || (is_readable($className) === false)) {
            return false;
        }

        require($className);

        return true;
    }
}