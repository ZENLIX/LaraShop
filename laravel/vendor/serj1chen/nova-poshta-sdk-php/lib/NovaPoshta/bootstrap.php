<?php

include_once 'Core/autoload.php';

if (!defined('NOVA_POSHTA_PATH_SDK')) {
    define('NOVA_POSHTA_PATH_SDK', dirname(__FILE__) . '/');

    \NovaPoshta\Core\Autoload::init();
}