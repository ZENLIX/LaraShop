<?php

namespace NovaPoshta\Core\Logger;

/**
 * Логирования
 * Interface Logger
 * @package NovaPoshta\Core
 */
interface InterfaceLogger
{
    /**
     * Данные оригинальные (сырые данные, в тому формате в котором отправляется запрос)
     *
     * @param $fromData string запрос
     * @param $toData string ответ
     * @return mixed
     */
    public static function setOriginalData($toData, $fromData);

    /**
     * Данные объектов запроса/ответа
     *
     * @param $fromData
     * @param $toData
     * @return mixed
     */
    public static function setData($toData, $fromData);
}