<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода documentsTracking модели InternetDocument
 *
 * Class InternetDocument_documentsTracking
 * @package NovaPoshta\DataMethods
 * @property array Documents
 */
class InternetDocument_documentsTracking extends MethodParameters
{
    /**
     * Устанавливает номера документов
     *
     * @param array $value
     * @return $this
     */
    public function setDocuments(array $value)
    {
        $this->Documents = $value;
        return $this;
    }

    /**
     * Устанавливает номер документа
     *
     * @return string
     */
    public function getDocuments()
    {
        return $this->Documents;
    }

    /**
     * Добавить номер документа
     *
     * @param string $value
     * @return $this
     */
    public function addDocument($value)
    {
        if (!$this->Documents) {
            $this->Documents = array();
        }
        $this->Documents[] = $value;
        return $this;
    }

    /**
     * Очищить номера документов
     *
     * @return $this
     */
    public function clearDocuments()
    {
        $this->DocumentRefumentRefs = array();
        return $this;
    }
}