<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getCounterpartyByEDRPOU модели Counterparty
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string EDRPOU
 * @property string CityRef
 */
class Counterparty_getCounterpartyByEDRPOU extends MethodParameters
{
    /**
     * Устанавливает ОКПО
     *
     * @param string $value
     * @return $this
     */
    public function setEDRPOU($value)
    {
        $this->EDRPOU = $value;
        return $this;
    }

    /**
     * Получить ОКПО
     *
     * @return string
     */
    public function getEDRPOU()
    {
        return $this->EDRPOU;
    }

    /**
     * Устанавливает реф города
     *
     * @param string $value
     * @return $this
     */
    public function setCityRef($value)
    {
        $this->CityRef = $value;
        return $this;
    }

    /**
     * Получить реф города
     *
     * @return string
     */
    public function getCityRef()
    {
        return $this->CityRef;
    }
}