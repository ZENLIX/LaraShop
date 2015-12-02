<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getCounterpartyOptions модели Counterparty
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string Ref
 */
class Counterparty_getCounterpartyOptions extends MethodParameters
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
}