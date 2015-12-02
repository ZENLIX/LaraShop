<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getTimeIntervals модели Common
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string RecipientCityRef
 * @property string DateTime
 */
class Common_getTimeIntervals extends MethodParameters
{
    /**
     * Устанавливает получателя реф города
     *
     * @param string $value
     * @return $this
     */
    public function setRecipientCityRef($value)
    {
        $this->RecipientCityRef = $value;
        return $this;
    }

    /**
     * Получает получателя реф города
     *
     * @return string
     */
    public function getRecipientCityRef()
    {
        return $this->RecipientCityRef;
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
     * Получает дату
     *
     * @return string
     */
    public function getDateTime()
    {
        return $this->DateTime;
    }
}