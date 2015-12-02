<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getCounterparties модели Counterparty
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string Ref
 * @property string CounterpartyProperty
 * @property string Page
 * @property string FindByString
 * @property string CityRef
 */
class Counterparty_getCounterparties extends MethodParameters
{
    /**
     * Идентификатор контрагента
     *
     * @param string $value
     * @return $this
     */
    public function setRef($value)
    {
        $this->Ref = $value;
        return $this;
    }

    /**
     * Возвращает реф
     *
     * @return string
     */
    public function getRef()
    {
        return $this->Ref;
    }

    /**
     * Устанавливает свойство контрагента
     *
     * @param string $value
     * @return $this
     */
    public function setCounterpartyProperty($value)
    {
        $this->CounterpartyProperty = $value;
        return $this;
    }

    /**
     * Получить свойство контрагента
     *
     * @return string
     */
    public function getCounterpartyProperty()
    {
        return $this->CounterpartyProperty;
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
     * Получить страницу
     *
     * @return string
     */
    public function getPage()
    {
        return $this->Page;
    }

    /**
     * Устанавливает строку для поиска контрагента
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
     * Получить строку для поиска контрагента
     *
     * @return string
     */
    public function getFindByString()
    {
        return $this->FindByString;
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