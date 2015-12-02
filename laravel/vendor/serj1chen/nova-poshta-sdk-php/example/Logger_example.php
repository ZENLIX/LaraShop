<?php

namespace NovaPoshta_example;

use NovaPoshta\Logger;

class Logger_example extends Logger
{
    public static function setOriginalData($toData, $fromData)
    {
        echo 'Send data:';
        echo '<br><br>';
        echo $toData;

        echo '<br><br>';

        echo 'Response data:';
        echo '<br><br>';
        echo $fromData;

        echo '<br><br>';
    }

    public static function setData($toData, $fromData)
    {
        echo 'Send data object:';
        echo '<br>';
        echo '<pre>';
        var_dump($toData);
        echo '</pre>';

        echo '<br><br>';

        echo 'Response data object:';
        echo '<br>';
        echo '<pre>';
        var_dump($fromData);
        echo '</pre>';
    }
}
