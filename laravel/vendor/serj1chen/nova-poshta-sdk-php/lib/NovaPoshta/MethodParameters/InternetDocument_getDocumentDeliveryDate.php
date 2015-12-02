<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getDocumentDeliveryDate модели InternetDocument
 *
 * Class InternetDocument_getDocumentDeliveryDate
 * @package NovaPoshta\DataMethods
 * @property string DateTime
 * @property string CitySender
 * @property string CityRecipient
 * @property string ServiceType
 */
class InternetDocument_getDocumentDeliveryDate extends MethodParameters
{
    /**
     * Устанавливает дату
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
     * Получить дату
     *
     * @return string
     */
    public function getDateTime()
    {
        return $this->DateTime;
    }

    /**
     * Устанавливает реф города отправителя
     *
     * @param string $value
     * @return $this
     */
    public function setCitySender($value)
    {
        $this->CitySender = $value;
        return $this;
    }

    /**
     * Получить реф города отправителя
     *
     * @return string
     */
    public function getCitySender()
    {
        return $this->CitySender;
    }

    /**
     * Устанавливает реф города получателя
     *
     * @param string $value
     * @return $this
     */
    public function setCityRecipient($value)
    {
        $this->CityRecipient = $value;
        return $this;
    }

    /**
     * Получить реф города получателя
     *
     * @return string
     */
    public function getCityRecipient()
    {
        return $this->CityRecipient;
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
     * Получить технологию доставки
     *
     * @return string
     */
    public function getServiceType()
    {
        return $this->ServiceType;
    }
}