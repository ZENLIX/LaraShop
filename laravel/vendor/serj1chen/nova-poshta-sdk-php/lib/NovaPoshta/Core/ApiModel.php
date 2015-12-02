<?php

namespace NovaPoshta\Core;

use NovaPoshta\Models\DataContainerResponse;
use stdClass;
use NovaPoshta\Models\DataContainer;

/**
 * Class ApiModel
 * @package NovaPoshta\Core
 */
abstract class ApiModel extends BaseModel
{
    private static $isBatch = false;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Пакетная передача данных
     *
     * @return bool
     */
    public static function isBatch()
    {
        self::$isBatch = true;
        return self::$isBatch;
    }

    /**
     * Отмена пакетной передачи данных
     *
     * @return bool
     */
    public static function notBatch()
    {
        self::$isBatch = false;
        return self::$isBatch;
    }

    protected function getThisData()
    {
        $data = new stdClass();
        foreach ($this as $key => $attr) {
            if (isset($this->{$key})) {
                $data->{$key} = $attr;
            }
        }

        return $data;
    }

    protected function objectInObject(&$fromObject, &$inObject)
    {
        foreach ($fromObject as $key => $value) {
            $inObject->{$key} = $value;
        }
    }

    /**
     * @param $methodName
     * @param null $data
     * @return DataContainerResponse
     */
    protected static function sendData($methodName, $data = null)
    {
        $dataContainer = new DataContainer();
        $dataContainer->modelName = self::_getCalledModel();
        $dataContainer->calledMethod = $methodName;
        $dataContainer->methodProperties = $data;

        return SendData::send($dataContainer, self::$isBatch);
    }

    /**
     * Получить пакетом данные
     *
     * @return array
     */
    public static function getResponseBatch()
    {
        return SendData::getResponseBatch();
    }

    private static function _getCalledModel()
    {
        $thisNameClass = explode('\\', get_called_class());

        return end($thisNameClass);
    }
}