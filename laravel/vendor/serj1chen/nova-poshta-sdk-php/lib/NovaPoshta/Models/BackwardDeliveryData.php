<?php

namespace NovaPoshta\Models;

use NovaPoshta\Core\BaseModel;

/**
 * Параметры обратной доставки
 *
 * Class BackwardDeliveryData
 * @package NovaPoshta\Models
 * @property string PayerType
 * @property string CargoType
 * @property string RedeliveryString
 * @property array  Trays
 */
class BackwardDeliveryData extends BaseModel
{
    /**
     * Устанавливает тип плательщика
     *
     * @param string $value
     * @return $this
     */
    public function setPayerType($value)
    {
        $this->PayerType = $value;
        return $this;
    }

    /**
     * Возвращает тип плательщика
     *
     * @return string
     */
    public function getPayerType()
    {
        return $this->PayerType;
    }

    /**
     * Устанавливает тип груза
     *
     * @param string $value
     * @return $this
     */
    public function setCargoType($value)
    {
        $this->CargoType = $value;
        return $this;
    }

    /**
     * Возвращает тип груза
     *
     * @return string
     */
    public function getCargoType()
    {
        return $this->CargoType;
    }

    /**
     * Устанавливает описания груза
     *
     * @param string $value
     * @return $this
     */
    public function setRedeliveryString($value)
    {
        $this->RedeliveryString = $value;
        return $this;
    }

    /**
     * Возвращает описания груза
     *
     * @return string
     */
    public function getRedeliveryString()
    {
        return $this->RedeliveryString;
    }

    /**
     * Добавляет поддон
     *
     * @param Cargo $cargo
     * @return $this
     */
    public function addTray(Cargo $cargo)
    {
        if(empty($this->Trays)){
            $this->Trays = array();
        }
        $this->Trays[] = $cargo;
        return $this;
    }

    /**
     * Устанавливает поддон
     *
     * @param array $trays
     */
    public function setTrays(array $trays)
    {
        $this->Trays = $trays;
    }

    /**
     * Возвращает поддоны
     *
     * @return null
     */
    public function getTrays()
    {
        return $this->Trays;
    }

    /**
     * Очищает поддоны
     *
     * @return $this
     */
    public function clearTrays()
    {
        $this->Trays = array();
        return $this;
    }
}