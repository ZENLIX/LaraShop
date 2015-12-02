<?php

namespace NovaPoshta\ApiModels;

use NovaPoshta\Core\ApiModel;
use NovaPoshta\MethodParameters\MethodParameters;

/**
 * Модель для работы с адресами
 *
 * Class Address
 * @package NovaPoshta\ApiModels
 *
 * @property string Ref
 * @property string CounterpartyRef
 * @property string StreetRef
 * @property string BuildingRef
 * @property string BuildingNumber
 * @property string Flat
 * @property string Note
 */
class Address extends ApiModel
{
    /**
     * Вызвать метод save() - создать адрес отправителя/получателя
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function save()
    {
        $data = $this->getThisData();

        return $this->sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод update() - редактировать адрес отправителя/получателя
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function update()
    {
        $data = $this->getThisData();

        return $this->sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод delete() - удалить ранее созданный адрес
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function delete()
    {
        $data = $this->getThisData();

        return $this->sendData(__FUNCTION__, $data);
    }

    /**
     * Устанавливает реф
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
     * Возвращает реф
     *
     * @return string
     */
    public function getRef()
    {
        return $this->Ref;
    }

    /**
     * Устанавливает реф контрагента
     *
     * @param string $value
     * @return $this
     */
    public function setCounterpartyRef($value)
    {
        $this->CounterpartyRef = $value;
        return $this;
    }

    /**
     * Возвращает реф контрагента
     *
     * @return string
     */
    public function getCounterpartyRef()
    {
        return $this->CounterpartyRef;
    }

    /**
     * Устанавливает реф улицы
     *
     * @param string $value
     * @return $this
     */
    public function setStreetRef($value)
    {
        $this->StreetRef = $value;
        return $this;
    }

    /**
     * Возвращает реф улицы
     *
     * @return string
     */
    public function getStreetRef()
    {
        return $this->StreetRef;
    }

    /**
     * Устанавливает номер дома
     *
     * @param string $value
     * @return $this
     */
    public function setBuildingNumber($value)
    {
        $this->BuildingNumber = $value;
        return $this;
    }

    /**
     * Возвращает номер дома
     *
     * @return string
     */
    public function getBuildingNumber()
    {
        return $this->BuildingNumber;
    }

    /**
     * Устанавливает номер квартиры
     *
     * @param string $value
     * @return $this
     */
    public function setFlat($value)
    {
        $this->Flat = $value;
        return $this;
    }

    /**
     * Возвращает номер квартиры
     *
     * @return string
     */
    public function getFlat()
    {
        return $this->Flat;
    }

    /**
     * Устанавливает комментарий
     *
     * @param string $value
     * @return $this
     */
    public function setNote($value)
    {
        $this->Note = $value;
        return $this;
    }

    /**
     * Возвращает комментарий
     *
     * @return string
     */
    public function getNote()
    {
        return $this->Note;
    }

    /**
     * Устанавливает реф дома
     *
     * @param  string$value
     * @return $this
     */
    public function setBuildingRef($value)
    {
        $this->BuildingRef = $value;
        return $this;
    }

    /**
     * Возвращает реф дома
     *
     * @return string
     */
    public function getBuildingRef()
    {
        return $this->BuildingRef;
    }

    /**
     * Вызвать метод getCities() - загрузить справочник городов компании «Новая Почта»
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getCities(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getStreet() - загрузить справочник улиц компании «Новая Почта»
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getStreet(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getWarehouses() - загрузить справочник отделений компании «Новая Почта»
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getWarehouses(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getAreas() - загрузить справочник географических областей Украины
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getAreas(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }
}
