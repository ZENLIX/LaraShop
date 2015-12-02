<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getCounterpartyContactPersons модели Counterparty
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string Ref
 * @property int    Page
 */
class Counterparty_getCounterpartyContactPersons extends MethodParameters
{
    /**
     * Устанавливает реф
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
     * Получить реф
     *
     * @return string
     */
    public function getRef()
    {
        return $this->Ref;
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
     * Получить страницу
     *
     * @return int
     */
    public function getPage()
    {
        return $this->Page;
    }
}