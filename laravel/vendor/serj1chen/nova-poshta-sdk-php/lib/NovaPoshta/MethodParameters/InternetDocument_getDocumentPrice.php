<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getDocumentPrice модели InternetDocument
 *
 * Class InternetDocument_documentsTracking
 * @package NovaPoshta\DataMethods
 * @property string CitySender
 * @property string CityRecipient
 * @property string ServiceType
 * @property float  Weight
 * @property float  Cost
 * @property string DateTime
 */
class InternetDocument_getDocumentPrice extends MethodParameters
{
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

    /**
     * Устанавливает вес
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
     * Получить вес
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->Weight;
    }

    /**
     * Устанавливает цену
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
     * Получить цену
     *
     * @return float
     */
    public function getCost()
    {
        return $this->Cost;
    }

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
}