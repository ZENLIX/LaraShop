<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getDocumentList модели InternetDocument
 *
 * Class InternetDocument_getDocumentList
 * @package NovaPoshta\DataMethods
 * @property string IntDocNumber
 * @property string InfoRegClientBarcodes
 * @property string DeliveryDateTime
 * @property string RecipientDateTime
 * @property string CreateTime
 * @property string SenderRef
 * @property string RecipientRef
 * @property float  WeightFrom
 * @property float  WeightTo
 * @property float  CostFrom
 * @property float  CostTo
 * @property int    SeatsAmountFrom
 * @property int    SeatsAmountTo
 * @property float  CostOnSiteFrom
 * @property float  CostOnSiteTo
 * @property array  StateIds
 * @property string DateTime
 * @property string DateTimeFrom
 * @property string DateTimeTo
 * @property bool   isAfterpayment
 * @property int    Page
 * @property string OrderField
 * @property string OrderDirection
 * @property string ScanSheetRef
 */
class InternetDocument_getDocumentList extends MethodParameters
{
    /**
     * Сортировка по убыванию
     */
    const ORDER_DIRECTION_DESC = 'DESC';
    /**
     * Сортировка по возрастанию
     */
    const ORDER_DIRECTION_ASC = 'ASC';

    /**
     * Сортировка по полю номер документа
     */
    const ORDER_FIELD_IntDocNumber = 'IntDocNumber';
    /**
     * Сортировка по полю дата отправки
     */
    const ORDER_FIELD_DateTime = 'DateTime';
    /**
     * Сортировка по полю вес
     */
    const ORDER_FIELD_Weight = 'Weight';
    /**
     * Сортировка по полю стоимость товара
     */
    const ORDER_FIELD_Cost = 'Cost';
    /**
     * Сортировка по полю количество мест
     */
    const ORDER_FIELD_SeatsAmount = 'SeatsAmount';
    /**
     * Сортировка по полю цена доставки
     */
    const ORDER_FIELD_CostOnSite = 'CostOnSite';
    /**
     * Сортировка по полю дата создания
     */
    const ORDER_FIELD_CreateTime = 'CreateTime';
    /**
     * Сортировка по полю дата доставки
     */
    const ORDER_FIELD_EstimatedDeliveryDate = 'EstimatedDeliveryDate';
    /**
     * Сортировка по полю статус доставки
     */
    const ORDER_FIELD_StateId = 'StateId';
    /**
     * Сортировка по полю внутренний номер клиента
     */
    const ORDER_FIELD_InfoRegClientBarcodes = 'InfoRegClientBarcodes';
    /**
     * Сортировка по полю дата фактическая дата доставки
     */
    const ORDER_FIELD_RecipientDateTime = 'RecipientDateTime';

    /**
     * Устанавливает номер документа
     *
     * @param string $value
     * @return $this
     */
    public function setIntDocNumber($value)
    {
        $this->IntDocNumber = $value;
        return $this;
    }

    /**
     * Получить номер документа
     *
     * @return string
     */
    public function getIntDocNumber()
    {
        return $this->IntDocNumber;
    }

    /**
     * Устанавливает номер внутреннего заказа клиента
     *
     * @param string $value
     * @return $this
     */
    public function setInfoRegClientBarcodes($value)
    {
        $this->InfoRegClientBarcodes = $value;
        return $this;
    }

    /**
     * Получить номер внутреннего заказа клиента
     *
     * @return string
     */
    public function getInfoRegClientBarcodes()
    {
        return $this->InfoRegClientBarcodes;
    }

    /**
     * Устанавливает дата доставки
     *
     * @param string $value
     * @return $this
     */
    public function setDeliveryDateTime($value)
    {
        $this->DeliveryDateTime = $value;
        return $this;
    }

    /**
     * Получить дата доставки
     *
     * @return string
     */
    public function getDeliveryDateTime()
    {
        return $this->DeliveryDateTime;
    }

    /**
     * Устанавливает фактическую дату и время получения
     *
     * @param string $value
     * @return $this
     */
    public function setRecipientDateTime($value)
    {
        $this->RecipientDateTime = $value;
        return $this;
    }

    /**
     * Получить фактическую дату и время получения
     *
     * @return string
     */
    public function getRecipientDateTime()
    {
        return $this->RecipientDateTime;
    }

    /**
     * Устанавливает дату и время создания ЕН
     *
     * @param string $value
     * @return $this
     */
    public function setCreateTime($value)
    {
        $this->CreateTime = $value;
        return $this;
    }

    /**
     * Получить дату и время создания ЕН
     *
     * @return string
     */
    public function getCreateTime()
    {
        return $this->CreateTime;
    }

    /**
     * Устанавливает идентификатор отправителя
     *
     * @param string $value
     * @return $this
     */
    public function setSenderRef($value)
    {
        $this->SenderRef = $value;
        return $this;
    }

    /**
     * Получить идентификатор отправителя
     *
     * @return string
     */
    public function getSenderRef()
    {
        return $this->SenderRef;
    }

    /**
     * Устанавливает идентификатор получателя
     *
     * @param string $value
     * @return $this
     */
    public function setRecipientRef($value)
    {
        $this->RecipientRef = $value;
        return $this;
    }

    /**
     * Получить идентификатор получателя
     *
     * @return string
     */
    public function getRecipientRef()
    {
        return $this->RecipientRef;
    }

    /**
     * Устанавливает вес от
     *
     * @param float $value
     * @return $this
     */
    public function setWeightFrom($value)
    {
        $this->WeightFrom = $value;
        return $this;
    }

    /**
     * Получить вес от
     *
     * @return float
     */
    public function getWeightFrom()
    {
        return $this->WeightFrom;
    }

    /**
     * Устанавливает вес до
     *
     * @param float $value
     * @return $this
     */
    public function setWeightTo($value)
    {
        $this->WeightTo = $value;
        return $this;
    }

    /**
     * Получить вес до
     *
     * @return float
     */
    public function getWeightTo()
    {
        return $this->WeightTo;
    }

    /**
     * Устанавливает объявленную стоимость от
     *
     * @param float $value
     * @return $this
     */
    public function setCostFrom($value)
    {
        $this->CostFrom = $value;
        return $this;
    }

    /**
     * Получить объявленную стоимость от
     *
     * @return float
     */
    public function getCostFrom()
    {
        return $this->CostFrom;
    }

    /**
     * Устанавливает объявленную стоимость до
     *
     * @param float $value
     * @return $this
     */
    public function setCostTo($value)
    {
        $this->CostTo = $value;
        return $this;
    }

    /**
     * Получить объявленную стоимость до
     *
     * @return float
     */
    public function getCostTo()
    {
        return $this->CostTo;
    }

    /**
     * Устанавливает количество мест от
     *
     * @param int $value
     * @return $this
     */
    public function setSeatsAmountFrom($value)
    {
        $this->SeatsAmountFrom = $value;
        return $this;
    }

    /**
     * Получить количество мест от
     *
     * @return int
     */
    public function getSeatsAmountFrom()
    {
        return $this->SeatsAmountFrom;
    }

    /**
     * Устанавливает количество мест до
     *
     * @param int $value
     * @return $this
     */
    public function setSeatsAmountTo($value)
    {
        $this->SeatsAmountTo = $value;
        return $this;
    }

    /**
     * Получить количество мест до
     *
     * @return int
     */
    public function getSeatsAmountTo()
    {
        return $this->SeatsAmountTo;
    }

    /**
     * Устанавливает стоимость доставки от
     *
     * @param float $value
     * @return $this
     */
    public function setCostOnSiteFrom($value)
    {
        $this->CostOnSiteFrom = $value;
        return $this;
    }

    /**
     * Получить стоимость доставки от
     *
     * @return float
     */
    public function getCostOnSiteFrom()
    {
        return $this->CostOnSiteFrom;
    }

    /**
     * Устанавливает стоимость доставки до
     *
     * @param float $value
     * @return $this
     */
    public function setCostOnSiteTo($value)
    {
        $this->CostOnSiteTo = $value;
        return $this;
    }

    /**
     * Получить стоимость доставки до
     *
     * @return float
     */
    public function getCostOnSiteTo()
    {
        return $this->CostOnSiteTo;
    }

    /**
     * Устанавливает статусы
     *
     * @param array $value
     * @return $this
     */
    public function setStateIds(array $value)
    {
        $this->StateIds = $value;
        return $this;
    }

    /**
     * Получить статусы
     *
     * @return string
     */
    public function getStateIds()
    {
        return $this->StateIds;
    }

    /**
     * Устанавливает дату отправки
     *
     * @param string $value
     * @return $this
     */
    public function setDateTime($value)
    {
        $this->DateTime = $value;
        return $this;
    }

    /**
     * Получить дату отправки
     *
     * @return string
     */
    public function getDateTime()
    {
        return $this->DateTime;
    }

    /**
     * Устанавливает дату отправки от
     *
     * @param string $value
     * @return $this
     */
    public function setDateTimeFrom($value)
    {
        $this->DateTimeFrom = $value;
        return $this;
    }

    /**
     * Получить дату отправки от
     *
     * @return string
     */
    public function getDateTimeFrom()
    {
        return $this->DateTimeFrom;
    }

    /**
     * Устанавливает дату отправки до
     *
     * @param string $value
     * @return $this
     */
    public function setDateTimeTo($value)
    {
        $this->DateTimeTo = $value;
        return $this;
    }

    /**
     * Получить дату отправки до
     *
     * @return string
     */
    public function getDateTimeTo()
    {
        return $this->DateTimeTo;
    }

    /**
     * Устанавливает контроль оплаты
     *
     * @param bool $value
     * @return $this
     */
    public function setIsAfterpayment($value)
    {
        $this->isAfterpayment = $value;
        return $this;
    }

    /**
     * Получить контроль оплаты
     *
     * @return bool
     */
    public function getIsAfterpayment()
    {
        return $this->isAfterpayment;
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
     * Получитьстраницу
     *
     * @return string
     */
    public function getPage()
    {
        return $this->Page;
    }

    /**
     * Устанавливает параметр сортировки
     *
     * @param string $value
     * @return $this
     */
    public function setOrderField($value)
    {
        $this->OrderField = $value;
        return $this;
    }

    /**
     * Получить параметр сортировки
     *
     * @return string
     */
    public function getOrderField()
    {
        return $this->OrderField;
    }

    /**
     * Устанавливает порядок сортировки
     *
     * @param string $value
     * @return $this
     */
    public function setOrderDirection($value)
    {
        $this->OrderDirection = $value;
        return $this;
    }

    /**
     * Получить порядок сортировки
     *
     * @return string
     */
    public function getOrderDirection()
    {
        return $this->OrderDirection;
    }

    /**
     * Устанавливает реф реестра
     *
     * @param string $value
     * @return $this
     */
    public function setScanSheetRef($value)
    {
        $this->ScanSheetRef = $value;
        return $this;
    }

    /**
     * Получить реф реестра
     *
     * @return string
     */
    public function getScanSheetRef()
    {
        return $this->ScanSheetRef;
    }
}