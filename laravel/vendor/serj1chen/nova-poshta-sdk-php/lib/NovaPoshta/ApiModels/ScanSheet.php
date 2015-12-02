<?php

namespace NovaPoshta\ApiModels;

use NovaPoshta\Config;
use NovaPoshta\Core\ApiModel;
use NovaPoshta\MethodParameters\MethodParameters;
use stdClass;


/**
 * ScanSheet - Модель для работы с реестрами приема-передачи отправлений
 *
 * @property array DocumentRefs
 * @property string Ref
 * @property string Date
 *
 * Class ScanSheet
 * @package NovaPoshta\ApiModels
 */
class ScanSheet extends ApiModel
{
    /**
     * Печать в формате PDF
     */
    const PRINT_TYPE_PDF = 'pdf';
    /**
     * Печать в формате HTML
     */
    const PRINT_TYPE_HTML = 'html';

    /**
     * Сохранить экспресс-накладные в реестр
     *
     * Реализация метода insertDocuments() - добавить экспресс-накладные в реестр
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function save()
    {
        $this->Ref = null;
        $data = $this->getThisData();
        return self::sendData('insertDocuments', $data);
    }

    /**
     * Обновить экспресс-накладные в реестр
     *
     * Реализация метода insertDocuments() - добавить экспресс-накладные в реестр
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function update()
    {
        $data = $this->getThisData();
        return self::sendData('insertDocuments', $data);
    }

    /**
     * Удалить реестр
     *
     * Реализация метода deleteScanSheet() - удалить (расформировать) реестр отправлений
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function delete()
    {
        $data = new stdClass();
        $data->ScanSheetRefs = array($this->Ref);
        return self::sendData('deleteScanSheet', $data);
    }

    /**
     * Устанавливает документы
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
     * Добавить реф документа
     *
     * @param $value
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
     * Очистить рефы документов
     *
     * @return $this
     */
    public function clearDocumentRefs()
    {
        $this->DocumentRefs = array();
        return $this;
    }

    /**
     * Устанавливает реф реестра
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
     * Возвращает реф реестра
     *
     * @return string
     */
    public function getRef()
    {
        return $this->Ref;
    }

    /**
     * Устанавливает дату
     *
     * @param string $value
     * @return $this
     */
    public function setDate($value)
    {
        $this->Date = $value;
        return $this;
    }

    /**
     * Возвращает дату
     *
     * @return string
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * Вызвать метод removeDocuments() - удалить экспресс-накладные из реестра
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function removeDocuments(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getScanSheet() - загрузить информацию по одному реестру
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getScanSheet(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getScanSheetList() - загрузить список реестров
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getScanSheetList(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод printScanSheet() - загрузка печатной формы реестра
     *
     * @param MethodParameters $data
     * @return string
     */
    public static function printScanSheet(MethodParameters $data = null)
    {
        $refs = isset($data->DocumentRefs) ? $data->DocumentRefs : null;

        if (empty($refs)) {
            return '';
        }

        $link = '';
        $link .= Config::getUrlMyNovaPoshta() . '/scanSheet/printScanSheet';

        foreach ($refs as $ref) {
            $link .= '/refs[]/' . $ref;
        }

        if (isset($data->Type)) {
            $link .= '/type/' . $data->Type;
        }

        $link .= '/apiKey/' . Config::getApiKey();

        return $link;
    }
}
