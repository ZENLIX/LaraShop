<?php

namespace NovaPoshta\Core\Logger;

use NovaPoshta\Config;

class BaseLogger
{
    public static function setDataLogger(DataLogger $dataLogger)
    {
        $classLogger = Config::getClassLogger();
        if($classLogger){
            $classLogger->setOriginalData($dataLogger->toOriginalData, $dataLogger->fromOriginalData);
            $classLogger->setData($dataLogger->toData, $dataLogger->fromData);
        }
    }
}