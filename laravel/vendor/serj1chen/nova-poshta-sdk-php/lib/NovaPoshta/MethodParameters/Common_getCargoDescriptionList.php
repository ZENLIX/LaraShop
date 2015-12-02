<?php

namespace NovaPoshta\MethodParameters;

/**
 * Параметры метода getCargoDescriptionList модели Common
 *
 * Class Address_getStreet
 * @package NovaPoshta\DataMethods
 * @property string Page
 * @property string FindByString
 */
class Common_getCargoDescriptionList extends MethodParameters
{
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
     * Получает страницу
     *
     * @return string
     */
    public function getPage()
    {
        return $this->Page;
    }

    /**
     * Устанавливает строку для поиска описания груза
     *
     * @param string $value
     * @return $this
     */
    public function setFindByString($value)
    {
        $this->FindByString = $value;
        return $this;
    }

    /**
     * Получает строку для поиска описания груза
     *
     * @return string
     */
    public function getFindByString()
    {
        return $this->FindByString;
    }
}