<?php

namespace NovaPoshta\Models;

use NovaPoshta\Core\BaseModel;

/**
 * Контрагент
 *
 * Class CounterpartyContact
 * @package NovaPoshta\Models
 * @property string Ref
 * @property string City
 * @property string Address
 * @property string Contact
 * @property string Phone
 */
class CounterpartyContact extends BaseModel
{
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
     * Устанавливает реф города
     *
     * @param string $value
     * @return $this
     */
    public function setCity($value)
    {
        $this->City = $value;
        return $this;
    }

    /**
     * Возвращает реф города
     *
     * @return string
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * Устанавливает
     *
     * @param string $value
     * @return $this
     */
    public function setAddress($value)
    {
        $this->Address = $value;
        return $this;
    }

    /**
     * Возвращает адрес
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * Устанавливает контактное лицо
     *
     * @param string $value
     * @return $this
     */
    public function setContact($value)
    {
        $this->Contact = $value;
        return $this;
    }

    /**
     * Возвращает контактное лицо
     *
     * @return string
     */
    public function getContact()
    {
        return $this->Contact;
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
        return $this->Phone;
    }
}