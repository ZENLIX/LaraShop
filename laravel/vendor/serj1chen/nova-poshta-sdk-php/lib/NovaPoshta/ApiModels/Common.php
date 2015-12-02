<?php

namespace NovaPoshta\ApiModels;

use NovaPoshta\Core\ApiModel;
use NovaPoshta\MethodParameters\MethodParameters;

/**
 * Common - Модель для работы со справочниками
 *
 * Class Common
 * @package NovaPoshta\ApiModels
 */
class Common extends ApiModel
{
    /**
     * Вызвать метод getBackwardDeliveryCargoTypes() - получить список видов обратной доставки груза
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getBackwardDeliveryCargoTypes()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getCargoDescriptionList() - загрузить справочник описания груза
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getCargoDescriptionList(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getCargoTypes() - загрузить список видов груза
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getCargoTypes()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getDocumentStatuses() - загрузить список статусов документов
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getDocumentStatuses()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getOwnershipFormsList() - загрузить список форм собственности
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getOwnershipFormsList()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getPalletsList() - загрузить список поддонов (при заказе услуги обратная доставка  поддонов)
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getPalletsList()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getPaymentForms() - загрузить список форм оплаты
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getPaymentForms()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getServiceTypes() - загрузить справочник технологий доставки
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getServiceTypes()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getTimeIntervals() - загрузить список временных интервалов (для заказа услуги "Временные интервалы")
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getTimeIntervals(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getTiresWheelsList() - загрузить список шин и дисков (если вид груза "шины-диски")
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getTiresWheelsList()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getTraysList() - загрузить список поддонов (если заказана услуга обратной доставки поддонов)
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getTraysList()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getTypesOfCounterparties() - загрузить список типов контрагентов отправителей
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getTypesOfCounterparties()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getTypesOfPayers() - загрузить список видов плательщиков
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getTypesOfPayers()
    {
        return self::sendData(__FUNCTION__);
    }

    /**
     * Вызвать метод getTypesOfPayersForRedelivery() - загрузить список видов плательщиков обратной доставки
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getTypesOfPayersForRedelivery()
    {
        return self::sendData(__FUNCTION__);
    }
}