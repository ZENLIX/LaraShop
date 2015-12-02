<?php

namespace NovaPoshta\MethodParameters;

/**
 * Class BasePrintDocumentParameters
 * @package NovaPoshta\DataMethods
 * @property array DocumentRefs
 * @property string Type
 * @property string Copies
 */
abstract class BasePrintDocumentParameters extends MethodParameters
{
    /**
     * Устанавливает рефы документов
     *
     * @param array $documentRefs
     * @return $this
     */
    public function setDocumentRefs(array $documentRefs)
    {
        $this->DocumentRefs = $documentRefs;
        return $this;
    }

    /**
     * Возвращает рефы документов
     *
     * @return string
     */
    public function getDocumentRefs()
    {
        return $this->DocumentRefs;
    }

    /**
     * очищает рефы документов
     *
     * @return $this
     */
    public function clearDocumentRefs()
    {
        $this->DocumentRefs = array();
        return $this;
    }

    /**
     * Добавляет реф документа
     *
     * @param string $value
     * @return $this
     */
    public function addDocumentRef($value)
    {
        if (!isset($this->DocumentRefs)) {
            $this->DocumentRefs = array();
        }
        $this->DocumentRefs[] = $value;
        return $this;
    }

    /**
     * Устанавливает тип печати
     *
     * @param string $value
     * @return $this
     */
    public function setType($value)
    {
        $this->Type = $value;
        return $this;
    }

    /**
     * Возвращает тип печати
     *
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * Устанавливает количество копий
     *
     * @param string $value
     * @return $this
     */
    public function setCopies($value)
    {
        $this->Copies = $value;
        return $this;
    }

    /**
     * Возвращает количество копий
     *
     * @return string
     */
    public function getCopies()
    {
        return $this->Copies;
    }
}