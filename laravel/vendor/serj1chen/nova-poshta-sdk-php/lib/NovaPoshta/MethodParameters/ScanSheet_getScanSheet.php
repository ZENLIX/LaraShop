<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getScanSheet модели ScanSheet
 *
 * Class ScanSheet_getScanSheet
 * @package NovaPoshta\DataMethods
 * @property string Ref
 */
class ScanSheet_getScanSheet extends MethodParameters
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
     * Возвращает реф
     *
     * @return string
     */
    public function getRef()
    {
        return $this->Ref;
    }
}