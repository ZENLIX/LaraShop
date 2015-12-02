<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода printScanSheet модели ScanSheet
 *
 * Class ScanSheet_printScanSheet
 * @package NovaPoshta\DataMethods
 * @property string Ref
 */
class ScanSheet_printScanSheet extends BasePrintDocumentParameters
{
    /**
     * Добавляет номер реестра
     *
     * @param string $value
     * @return $this
     */
    public function addNumber($value)
    {
        return $this->addDocumentRef($value);
    }

    /**
     * Устанавливает номера реестров
     *
     * @param array $numbers
     * @return $this
     */
    public function setNumbers(array $numbers)
    {
        return $this->setDocumentRefs($numbers);
    }

    /**
     * Возвращает номера реестров
     *
     * @return string
     */
    public function getNumbers()
    {
        return $this->getDocumentRefs();
    }

    /**
     * Очищает номера реестров
     *
     * @return $this
     */
    public function clearNumbers()
    {
        return $this->clearDocumentRefs();
    }
}