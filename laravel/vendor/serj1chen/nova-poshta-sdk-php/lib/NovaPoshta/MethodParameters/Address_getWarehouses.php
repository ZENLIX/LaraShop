<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getWarehouses модели Address
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string CityRef
 * @property string Page
 */
class Address_getWarehouses extends MethodParameters
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
     * Возвращает реф города
     *
     * @return string
     */
    public function getCityRef()
    {
        return $this->CityRef;
    }

    /**
     * Устанавливает страницу
     *
     * @param string $value
     * @return $this
     */
    public function setPage($value)
    {
        $this->Page = $value;
        return $this;
    }

    /**
     * Возвращает страницу
     *
     * @return string
     */
    public function getPage()
    {
        return $this->Page;
    }
}