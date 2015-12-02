<?php

namespace NovaPoshta\ApiModels;

use NovaPoshta\Core\ApiModel;

/**
 * ContactPerson - Модель для создания контактного лица
 * 
 * Class ContactPerson
 * @package NovaPoshta\ApiModels
 * 
 * @property string Ref
 * @property string CounterpartyRef
 * @property string FirstName
 * @property string LastName
 * @property string MiddleName
 * @property string Email
 * 
 * Class ContactPerson
 * @package NovaPoshta\ApiModels
 */
class ContactPerson extends ApiModel
{
    /**
     * Вызвать метод save() - сохранить данные контактного лица отправителя/получателя
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function save()
    {
        return $this->sendData(__function__, $this->getThisData());
    }

    /**
     * Вызвать метод update() - обновить данные контактного лица
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function update()
    {
        return $this->sendData(__function__, $this->getThisData());
    }

    /**
     * Вызвать метод delete() - удалить контактное лицо отправителя/получателя
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function delete()
    {
        return $this->sendData(__function__, $this->getThisData());
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
     * Устанавливает фамилию
     * 
     * @param string $value
     * @return $this
     */
    public function setFirstName($value)
    {
        $this->FirstName = $value;
        return $this;
    }

    /**
     * Возвращает фамилию
     * 
     * @return string
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * Устанавливает имя
     * 
     * @param string $value
     * @return $this
     */
    public function setLastName($value)
    {
        $this->LastName = $value;
        return $this;
    }

    /**
     * Возвращает имя
     * 
     * @return string
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * Устанавливает отчество
     * 
     * @param string $value
     * @return $this
     */
    public function setMiddleName($value)
    {
        $this->MiddleName = $value;
        return $this;
    }

    /**
     * Возвращает отчество
     * 
     * @return string
     */
    public function getMiddleName()
    {
        return $this->MiddleName;
    }

    /**
     * Устанавливает номер телефона
     * 
     * @param string $value
     * @return $this
     */
    public function setPhone($value)
    {
        $this->Phone = $value;
        return $this;
    }

    /**
     * Возвращает номер телефона
     * 
     * @return string
     */
    public function getPhone()
    {
        return $this->Ref;
    }

    /**
     * Устанавливает email
     * 
     * @param string $value
     * @return $this
     */
    public function setEmail($value)
    {
        $this->Email = $value;
        return $this;
    }

    /**
     * Возвращает email
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }
}