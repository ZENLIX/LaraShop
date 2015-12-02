<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getStreet модели Address
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string CityRef
 * @property int    Page
 * @property string FindByString
 */
class Address_getStreet extends MethodParameters
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
     * @param int $value
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
     * @return int
     */
    public function getPage()
    {
        return $this->Page;
    }

    /**
     * Устанавливает строку для поиска улицы
     *
     * @param string $value
     * @return $this
     */
    public function setFindByString($value)
    {
        $this->FindByString = $value;
        return $this;
    }

    /**
     * Возвращает строку для поиска улицы
     *
     * @return string
     */
    public function getFindByString()
    {
        return $this->FindByString;
    }
}