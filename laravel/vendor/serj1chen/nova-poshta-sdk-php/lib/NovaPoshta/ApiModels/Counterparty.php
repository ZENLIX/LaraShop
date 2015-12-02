<?php

namespace NovaPoshta\ApiModels;

use NovaPoshta\Core\ApiModel;
use NovaPoshta\MethodParameters\MethodParameters;


/**
 * Counterparty - Модель для работы с данными контрагента
 *
 * Class Counterparty
 * @package NovaPoshta\ApiModels
 *
 * @property string Ref
 * @property string CounterpartyProperty
 * @property string CityRef
 * @property string CounterpartyType
 * @property string FirstName
 * @property string LastName
 * @property string MiddleName
 * @property string Phone
 * @property string Email
 * @property string OwnershipForm
 * @property string EDRPOU
 */
class Counterparty extends ApiModel
{
    /**
     * Отправитель
     */
    const SENDER = 'Sender';
    /**
     * Получатель
     */
    const RECIPIENT = 'Recipient';
    /**
     * Третье лицо
     */
    const THIRD_PERSON = 'ThirdPerson';

    /**
     * Вызвать метод save() - сохранить контрагента
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function save()
    {
        return $this->sendData(__FUNCTION__, $this->getThisData());
    }

    /**
     * Вызвать метод update() - обновить данные контрагента
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function update()
    {
        return $this->sendData(__FUNCTION__, $this->getThisData());
    }

    /**
     * Вызвать метод saveThirdPerson() - сохранить контрагента с типом "третье лицо"
     * Функция доступна для клиентов, заключивших договор с компанией "Новая Почта"
     */
    public function saveThirdPerson()
    {
        $this->setCounterpartyProperty(self::THIRD_PERSON);

        return $this->sendData(__FUNCTION__, $this->getThisData());
    }

    /**
     * Вызвать метод updateThirdPerson() - обновить данные контрагента с типом "третье лицо"
     * Функция доступна для клиентов, заключивших договор с компанией "Новая Почта"
     */
    public function updateThirdPerson()
    {
        $this->setCounterpartyProperty(self::THIRD_PERSON);

        return $this->sendData(__FUNCTION__, $this->getThisData());
    }

    /**
     * Вызвать метод delete() - удалить контрагента отправителя/получателя
     *
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public function delete()
    {
        return $this->sendData(__FUNCTION__, $this->getThisData());
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
     * Устанавливает свойство контрагента
     *
     * @param string $value
     * @return $this
     */
    public function setCounterpartyProperty($value)
    {
        $this->CounterpartyProperty = $value;
        return $this;
    }

    /**
     * Возвращает свойство контрагента
     *
     * @return string
     */
    public function getCounterpartyProperty()
    {
        return $this->CounterpartyProperty;
    }

    /**
     * Устанавливает реф города
     *
     * @param string $value
     * @return $this
     */
    public function setCityRef($value)
    {
        $this->CityRef = $value;
        return $this;
    }

    /**
     * Возвращает реф города
     *
     * @return string
     */
    public function getCityRef()
    {
        return $this->CityRef;
    }

    /**
     * Устанавливает тип контрагента
     *
     * @param string $value
     * @return $this
     */
    public function setCounterpartyType($value)
    {
        $this->CounterpartyType = $value;
        return $this;
    }

    /**
     * Возвращает тип контрагента
     *
     * @return string
     */
    public function getCounterpartyType()
    {
        return $this->CounterpartyType;
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

    /**
     * Устанавливает ОКПО
     *
     * @param string $value
     * @return $this
     */
    public function setEDRPOU($value)
    {
        $this->EDRPOU = $value;
        return $this;
    }

    /**
     * Возвращает ОКПО
     *
     * @return string
     */
    public function getEDRPOU()
    {
        return $this->EDRPOU;
    }

    /**
     * Устанавливает форму собственности
     *
     * @param string $value
     * @return $this
     */
    public function setOwnershipForm($value)
    {
        $this->OwnershipForm = $value;
        return $this;
    }

    /**
     * Возвращает форму собственности
     *
     * @return string
     */
    public function getOwnershipForm()
    {
        return $this->OwnershipForm;
    }

    /**
     * Вызвать метод cloneLoyaltyCounterpartySender() - создать контрагента-отправителя в выбранном
     * городе (для участников программы лояльности)
     *
     * Метод: cloneLoyaltyCounterpartySender — создает контрагента-отправителя, если выбранный город-отправитель
     * отличается от города в котором зарегистрирован пользователь
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function cloneLoyaltyCounterpartySender(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getCounterparties() - загрузить список контрагентов отправителей/получателей
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getCounterparties(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getCounterpartyAddresses() - загрузить список адресов контрагентов
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getCounterpartyAddresses(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getCounterpartyContactPersons() - загрузить список контактных лиц контрагента
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getCounterpartyContactPersons(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getCounterpartyByEDRPOU() - найти контрагента по коду ОКПО
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getCounterpartyByEDRPOU(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }

    /**
     * Вызвать метод getCounterpartyOptions() - загрузить параметры контрагента
     *
     * @param MethodParameters $data
     * @return \NovaPoshta\Models\DataContainerResponse
     */
    public static function getCounterpartyOptions(MethodParameters $data = null)
    {
        return self::sendData(__FUNCTION__, $data);
    }
}