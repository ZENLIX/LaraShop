<?php

namespace NovaPoshta\ApiModels;

use NovaPoshta\Models\BackwardDeliveryData;
use NovaPoshta\Models\Cargo;
use NovaPoshta\Models\OptionsSeat;
use NovaPoshta\Core\ApiModel;
use NovaPoshta\Models\CounterpartyContact;
use NovaPoshta\Config;
use NovaPoshta\MethodParameters\MethodParameters;
use stdClass;

/**
 * InternetDocument - Модель для оформления отправлений
 *
 * @property CounterpartyContact Sender
 * @property CounterpartyContact Recipient
 * @property string              ThirdPerson
 * @property string              Ref
 * @property string              DateTime
 * @property string              ServiceType
 * @property string              PaymentMethod
 * @property string              PayerType
 * @property float               Cost
 * @property int                 SeatsAmount
 * @property string              Description
 * @property string              CargoType
 * @property float               Weight
 * @property float               VolumeWeight
 * @property float               VolumeGeneral
 * @property string              Pack
 * @property string              AdditionalInformation
 * @property string              PackingNumber
 * @property string              InfoRegClientBarcodes
 * @property bool                SaturdayDelivery
 * @property string              SameDayDelivery
 * @property string              ForwardingCount
 * @property bool                IsTakeAttorney
 * @property string              PreferredDeliveryDate
 * @property string              TimeInterval
 * @property string              NumberOfFloorsLifting
 * @property string              AccompanyingDocuments
 * @property array               CargoDetails
 * @property array               OptionsSeat
 * @property array               BackwardDeliveryData
 *
 * Class InternetDocument
 * @package NovaPoshta\ApiModels
 */
class InternetDocument extends ApiModel
{
    /**
     * Печать в формате PDF
     */
    const PRINT_TYPE_PDF = 'Pdf';
    /**
     * Печать в формате HTML
     */
    const PRINT_TYPE_HTML = 'Html';

    /**
     * Печатать 2 экземпляра
     */
    const PRINT_COPIES_DOUBLE = 'double';
    /**
     * Печатать 4 экземпляра
     */
    const PRINT_COPIES_FOURFOLD = 'fourfold';

    private function getDataInternetDocument()
    {
        $data = new stdClass();

        foreach ($this as $key => $attr) {
            if($attr instanceof CounterpartyContact){
                $data->{'City' . $key} = $attr->getCity();
                $data->{$key} = $attr->getRef();
                $data->{$key . 'Address'} = $attr->getAddress();
                $data->{'Contact' . $key} = $attr->getContact();
                $data->{$key . 'sPhone'} = $attr->getPhone();
            } elseif (isset($this->{$key})) {
                $data->{$key} = $attr;
            }
        }

        return $data;
    }

    /**
     * Устанавливает реф документа
     *
     * @param $value
     * @return $this
     */
    public function setRef($value)
    {
        $this->Ref = $value;
        return $this;
    }

    /**
     * Возвращает реф документа
     *
     * @return string
     */
    public function getRef()
    {
        return $this->Ref;
    }

    /**
     * Устанавливает отправителя
     *
     * @param CounterpartyContact $counterparty
     * @return $this
     */
    public function setSender(CounterpartyContact $counterparty)
    {
        $this->Sender = $counterparty;
        return $this;
    }

    /**
     * Возвращает отправителя
     *
     * @return CounterpartyContact
     */
    public function getSender()
    {
        return $this->Sender;
    }

    /**
     * Устанавливает получателя
     *
     * @param CounterpartyContact $counterparty
     * @return $this
     */
    public function setRecipient(CounterpartyContact $counterparty)
    {
        $this->Recipient = $counterparty;
        return $this;
    }

    /**
     * Возвращает получателя
     *
     * @return CounterpartyContact
     */
    public function getRecipient()
    {
        return $this->Recipient;
    }

    /**
     * Устанавливает третье лицо
     *
     * @param CounterpartyContact $counterparty
     * @return $this
     */
    public function setThirdPerson(CounterpartyContact $counterparty)
    {
        $this->ThirdPerson = $counterparty;
        return $this;
    }

    /**
     * Возвращает третье лицо
     *
     * @return CounterpartyContact
     */
    public function getThirdPerson()
    {
        return $this->ThirdPerson;
    }

    /**
     * Устанавливает дата создания
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
     * Возвращает дата создания
     *
     * @return string
     */
    public function getDateTime()
    {
        return $this->DateTime;
    }

    /**
     * Устанавливает технологию доставки
     *
     * @param string $value
     * @return $this
     */
    public function setServiceType($value)
    {
        $this->ServiceType = $value;
        return $this;
    }

    /**
     * Возвращает технологию доставки
     *
     * @return string
     */
    public function getServiceType()
    {
        return $this->ServiceType;
    }

    /**
     * Устанавливает форму оплаты
     *
     * @param string $value
     * @return $this
     */
    public function setPaymentMethod($value)
    {
        $this->PaymentMethod = $value;
        return $this;
    }

    /**
     * Возвращает форму оплаты
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->PaymentMethod;
    }

    /**
     * Устанавливает плательщика
     *
     * @param string $value
     * @return $this
     */
    public function setPayerType($value)
    {
        $this->PayerType = $value;
        return $this;
    }

    /**
     * Возвращает плательщика
     *
     * @return string
     */
    public function getPayerType()
    {
        return $this->PayerType;
    }

    /**
     * Устанавливает объявленную стоимость
     *
     * @param float $value
     * @return $this
     */
    public function setCost($value)
    {
        $this->Cost = $value;
        return $this;
    }

    /**
     * Возвращает объявленную стоимость
     *
     * @return float
     */
    public function getCost()
    {
        return $this->Cost;
    }

    /**
     * Устанавливает количество мест отправления
     *
     * @param int $value
     * @return $this
     */
    public function setSeatsAmount($value)
    {
        $this->SeatsAmount = $value;
        return $this;
    }

    /**
     * Возвращает количество мест отправления
     *
     * @return int
     */
    public function getSeatsAmount()
    {
        return $this->SeatsAmount;
    }

    /**
     * Устанавливает описания груза
     *
     * @param string $value
     * @return $this
     */
    public function setDescription($value)
    {
        $this->Description = $value;
        return $this;
    }

    /**
     * Возвращает описания груза
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * Устанавливает вид обратной доставки
     *
     * @param string $value
     * @return $this
     */
    public function setCargoType($value)
    {
        $this->CargoType = $value;
        return $this;
    }

    /**
     * Возвращает вид обратной доставки
     *
     * @return string
     */
    public function getCargoType()
    {
        return $this->CargoType;
    }

    /**
     * Устанавливает вес фактический, кг
     *
     * @param float $value
     * @return $this
     */
    public function setWeight($value)
    {
        $this->Weight = $value;
        return $this;
    }

    /**
     * Возвращает вес фактический, кг
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->Weight;
    }

    /**
     * Устанавливает вес объемный, кг
     *
     * @param float $value
     * @return $this
     */
    public function setVolumeWeight($value)
    {
        $this->VolumeWeight = $value;
        return $this;
    }

    /**
     * Возвращает вес объемный, кг
     *
     * @return float
     */
    public function getVolumeWeight()
    {
        return $this->VolumeWeight;
    }

    /**
     * Устанавливает объем общий, м.куб
     *
     * @param float $value
     * @return $this
     */
    public function setVolumeGeneral($value)
    {
        $this->VolumeGeneral = $value;
        return $this;
    }

    /**
     * Возвращает объем общий, м.куб
     *
     * @return float
     */
    public function getVolumeGeneral()
    {
        return $this->VolumeGeneral;
    }

    /**
     * Устанавливает вид упаковки
     *
     * @param $value
     * @return $this
     */
    public function setPack($value)
    {
        $this->Pack = $value;
        return $this;
    }

    /**
     * Возвращает вид упаковки
     *
     * @return string
     */
    public function getPack()
    {
        return $this->Pack;
    }

    /**
     * Устанавливает дополнительную информацию об отправлении (любая, необходимая Клиенту информация в ЭН)
     *
     * @param string $value
     * @return $this
     */
    public function setAdditionalInformation($value)
    {
        $this->AdditionalInformation = $value;
        return $this;
    }

    /**
     * Возвращает дополнительную информацию об отправлении (любая, необходимая Клиенту информация в ЭН)
     *
     * @return string
     */
    public function getAdditionalInformation()
    {
        return $this->AdditionalInformation;
    }

    /**
     * Устанавливает № упаковки
     *
     * @param string $value
     * @return $this
     */
    public function setPackingNumber($value)
    {
        $this->PackingNumber = $value;
        return $this;
    }

    /**
     * Возвращает № упаковки
     *
     * @return string
     */
    public function getPackingNumber()
    {
        return $this->PackingNumber;
    }

    /**
     * Устанавливает номер внутреннего заказа Клиента (не хранится в ИС "Новая Почта")
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
     * Возвращает номер внутреннего заказа Клиента (не хранится в ИС "Новая Почта")
     *
     * @return string
     */
    public function getInfoRegClientBarcodes()
    {
        return $this->InfoRegClientBarcodes;
    }

    /**
     * Устанавливает субботнюю доставку
     *
     * @param bool $value
     * @return $this
     */
    public function setSaturdayDelivery($value)
    {
        $this->SaturdayDelivery = $value;
        return $this;
    }

    /**
     * Возвращает субботнюю доставку
     *
     * @return bool
     */
    public function getSaturdayDelivery()
    {
        return $this->SaturdayDelivery;
    }

    /**
     * Устанавливает день-в-день
     *
     * @param string $value
     * @return $this
     */
    public function setSameDayDelivery($value)
    {
        $this->SameDayDelivery = $value;
        return $this;
    }

    /**
     * Возвращает день-в-день
     *
     * @return string
     */
    public function getSameDayDelivery()
    {
        return $this->SameDayDelivery;
    }

    /**
     * Устанавливает экспедирование
     *
     * @param string $value
     * @return $this
     */
    public function setForwardingCount($value)
    {
        $this->ForwardingCount = $value;
        return $this;
    }

    /**
     * Возвращает экспедирование
     *
     * @return string
     */
    public function getForwardingCount()
    {
        return $this->ForwardingCount;
    }

    /**
     * Устанавливает забор доверенности
     *
     * @param bool $value
     * @return $this
     */
    public function setIsTakeAttorney($value)
    {
        $this->IsTakeAttorney = $value;
        return $this;
    }

    /**
     * Возвращает забор доверенности
     *
     * @return bool
     */
    public function getIsTakeAttorney()
    {
        return $this->IsTakeAttorney;
    }

    /**
     * Устанавливает желаемаую дату доставки
     *
     * @param string $value
     * @return $this
     */
    public function setPreferredDeliveryDate($value)
    {
        $this->PreferredDeliveryDate = $value;
        return $this;
    }

    /**
     * Возвращает желаемаую дату доставки
     *
     * @return string
     */
    public function getPreferredDeliveryDate()
    {
        return $this->PreferredDeliveryDate;
    }

    /**
     * Устанавливает доставку временных интервалов
     *
     * @param string $value
     * @return $this
     */
    public function setTimeInterval($value)
    {
        $this->TimeInterval = $value;
        return $this;
    }

    /**
     * Возвращает доставку временных интервалов
     *
     * @return string
     */
    public function getTimeInterval()
    {
        return $this->TimeInterval;
    }

    /**
     * Добавляет параметры груза
     *
     * @param Cargo $value
     * @return $this
     */
    public function addCargoDetail(Cargo $value)
    {
        if (!isset($this->CargoDetails)) {
            $this->CargoDetails = array();
        }
        $this->CargoDetails[] = $value;
        return $this;
    }

    /**
     * Возвращает параметры груза
     *
     * @return array
     */
    public function getCargoDetails()
    {
        if (!isset($this->CargoDetails)) {
            $this->CargoDetails = array();
        }
        return $this->CargoDetails;
    }

    /**
     * Очищает параметры груза
     *
     * @return $this
     */
    public function clearCargoDetails()
    {
        $this->CargoDetails = array();
        return $this;
    }

    /**
     * Добавляет параметры места
     *
     * @param OptionsSeat $value
     * @return $this
     */
    public function addOptionsSeat(OptionsSeat $value)
    {
        if (!isset($this->OptionsSeat)) {
            $this->OptionsSeat = array();
        }
        $this->OptionsSeat[] = $value;
        return $this;
    }

    /**
     * Возвращает параметры мест
     *
     * @return array
     */
    public function getOptionsSeats()
    {
        if (!isset($this->OptionsSeat)) {
            $this->OptionsSeat = array();
        }
        return $this->OptionsSeat;
    }

    /**
     * Очищает параметры мест
     *
     * @return $this
     */
    public function clearOptionsSeat()
    {
        $this->OptionsSeat = array();
        return $this;
    }

    /**
     * Добавляет обратную доставку
     *
     * @param BackwardDeliveryData $value
     * @return $this
     */
    public function addBackwardDeliveryData(BackwardDeliveryData $value)
    {
        if (!isset($this->BackwardDeliveryData)) {
            $this->BackwardDeliveryData = array();
        }
        $this->BackwardDeliveryData[] = $value;
        return $this;
    }

    /**
     * Возвращает обратную доставку
     *
     * @return array
     */
    public function getBackwardDeliveryData()
    {
        if (!isset($this->BackwardDeliveryData)) {
            $this->BackwardDeliveryData = array();
        }
        return $this->BackwardDeliveryData;
    }

    /**
     * Очищает  обратную доставку
     *
     * @return $this
     */
    public function clearBackwardDeliveryData()
    {
        $this->BackwardDeliveryData = array();
        return $this;
    }

    /**
     * Устанавливает подъем на этаж
     *
     * @param $value
     * @return $this
     */
    public function setNumberOfFloorsLifting($value)
    {
        $this->NumberOfFloorsLifting = $value;
        return $this;
    }

    /**
     * Устанавливает подъем на этаж
     *
     * @return string
     */
    public function getNumberOfFloorsLifting()
    {
        return $this->NumberOfFloorsLifting;
    }

    /**
     * Устанавливает сопровождающие документы
     *
     * @param $value
     * @return $this
     */
    public function setAccompanyingDocuments($value)
    {
        $this->AccompanyingDocuments = $value;
        return $this;
    }

    /**
     * Возвращает сопровождающие документы
     *
     * @return string
     */
    public function getAccompanyingDocuments()
    {
        return $this->AccompanyingDocuments;
    }

    /**
     * Вызвать метод save() - создание ЭН
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function save()
    {
        return $this->sendData(__FUNCTION__, $this->getDataInternetDocument());
    }

    /**
     * Вызвать метод update() - редактирование ЭН
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function update()
    {
        return $this->sendData(__FUNCTION__, $this->getDataInternetDocument());
    }

    /**
     * Вызвать метод delete() - удаление документа
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function delete()
    {
        $this->DocumentRefs = array($this->Ref);
        return $this->sendData(__FUNCTION__, $this->getThisData());
    }

    /**
     * Вызвать метод getDocumentDeliveryDate() - ориентировочная дата доставки
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getDocumentDeliveryDate(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getDocument() - получить ЭН
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getDocument(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getDocumentList() - получает список ЭН
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getDocumentList(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод printDocument() - печать ЭН
     *
     * @param MethodParameters $data
     * @return string
     */
    public static function printDocument(MethodParameters $data = null)
    {
        $link = self::getPrintLink('printDocument', $data);

        return $link;
    }

    /**
     * Вызвать метод printMarkings() - печать маркировок
     *
     * @param MethodParameters $data
     * @return string
     */
    public static function printMarkings(MethodParameters $data = null)
    {
        $link = self::getPrintLink('printMarkings', $data);

        return $link;
    }

    /**
     * Вызвать метод documentsTracking() - трекинг документов
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function documentsTracking(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getDocumentPrice() - расчет стоимости доставки
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getDocumentPrice(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    private static function getPrintLink($typePrint, MethodParameters $data = null)
    {
        $refs = isset($data->DocumentRefs) ? $data->DocumentRefs : null;

        if (empty($refs)) {
            return '';
        }

        $link = '';
        $link .= Config::getUrlMyNovaPoshta() . '/orders/' . $typePrint;

        foreach ($refs as $ref) {
            if (isset($data->Copies) && $data->Copies == self::PRINT_COPIES_FOURFOLD) {
                $link .= '/orders[]/' . $ref;
            }

            $link .= '/orders[]/' . $ref;
        }

        if (isset($data->Type)) {
            $link .= '/type/' . $data->Type;
        }

        $link .= '/apiKey/' . Config::getApiKey();

        return $link;
    }
}