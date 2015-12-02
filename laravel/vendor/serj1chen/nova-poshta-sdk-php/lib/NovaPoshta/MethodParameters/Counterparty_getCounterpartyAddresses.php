<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getCounterpartyAddresses модели Counterparty
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string Ref
 * @property string Page
 */
class Counterparty_getCounterpartyAddresses extends MethodParameters
{
    /**
     * Устанавливет реф
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
}