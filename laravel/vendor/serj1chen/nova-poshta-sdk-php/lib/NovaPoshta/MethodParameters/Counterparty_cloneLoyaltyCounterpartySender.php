<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода cloneLoyaltyCounterpartySender модели Counterparty
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string CityRef
 */
class Counterparty_cloneLoyaltyCounterpartySender extends MethodParameters
{
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