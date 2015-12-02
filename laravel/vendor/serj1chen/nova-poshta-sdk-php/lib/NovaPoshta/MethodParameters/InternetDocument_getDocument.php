<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getDocument модели InternetDocument
 *
 * Class InternetDocument_documentsTracking
 * @package NovaPoshta\DataMethods
 * @property string Ref
 */
class InternetDocument_getDocument extends MethodParameters
{
    /**
     * Устанавливает реф документа
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
     * Получить реф документа
     *
     * @return string
     */
    public function getRef()
    {
        return $this->Ref;
    }
}