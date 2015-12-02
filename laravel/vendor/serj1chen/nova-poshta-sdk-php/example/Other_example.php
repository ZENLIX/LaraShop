<?php

namespace NovaPoshta_example;


class Other_example
{
    // Создать ЕН
    public static function createEN()
    {
        // Выбираем город отправителя
        $data = new \NovaPoshta\MethodParameters\Address_getCities();
        $data->setFindByString('Полтава');
        $result = \NovaPoshta\ApiModels\Address::getCities($data);
        $citySender = $result->data[0]->Ref;

        // Выбираем город получателя
        $result = \NovaPoshta\ApiModels\Address::getCities(); // список городов
        $cityRecipient = $result->data[60]->Ref;

        // Выбираем тип контрагента
        $result = \NovaPoshta\ApiModels\Common::getTypesOfCounterparties();
        $counterpartyType = $result->data[1]->Ref; // со списка выбираем тип PrivatePerson

        // Создаем контрагента получателя
        $counterparty = new \NovaPoshta\ApiModels\Counterparty();
        $counterparty->setCounterpartyProperty(\NovaPoshta\ApiModels\Counterparty::RECIPIENT);
        $counterparty->setCityRef($cityRecipient);
        $counterparty->setCounterpartyType($counterpartyType);
        $counterparty->setFirstName('Пилипко');
        $counterparty->setLastName('Вася');
        $counterparty->setMiddleName('Сергеевич');
        $counterparty->setPhone('+380661122333');
        $counterparty->setEmail('test@i.ua');
        $result = $counterparty->save();
        $counterpartyRecipient = $result->data[0]->Ref;

        // Если нет контрагента отправителя в городе Полтава, создаем там контрагента отправителя. Контрагент
        // создастся через несколько минут
        $data = new \NovaPoshta\MethodParameters\Counterparty_cloneLoyaltyCounterpartySender();
        $data->setCityRef($citySender);
        $result = \NovaPoshta\ApiModels\Counterparty::cloneLoyaltyCounterpartySender($data);
        // Если у Вас есть контрагент отправитель, то получаем его так же как контрагента получателя, только сюда:
        // setCounterpartyProperty передаем \NovaPoshta\ApiModels\Counterparty::SENDER.
        // Методом cloneLoyaltyCounterpartySender можно использовать только если Вы клиент лояльности, если Вы
        // корпоративный клиент, то у Вас уже должен быть контрагент отправитель в нужном городе.

        // Теперь получим контрагента отправителя
        $data = new \NovaPoshta\MethodParameters\Counterparty_getCounterparties();
        $data->setCityRef($citySender);
        $data->setCounterpartyProperty(\NovaPoshta\ApiModels\Counterparty::SENDER);
        $result = \NovaPoshta\ApiModels\Counterparty::getCounterparties($data);
        $counterpartySender = $result->data[0]->Ref;

        // Получим контактных персон для контрагентов
        $data = new \NovaPoshta\MethodParameters\Counterparty_getCounterpartyContactPersons();
        $data->setRef($counterpartySender);
        $result = \NovaPoshta\ApiModels\Counterparty::getCounterpartyContactPersons($data);
        $contactPersonSender = $result->data[0]->Ref;

        $data = new \NovaPoshta\MethodParameters\Counterparty_getCounterpartyContactPersons();
        $data->setRef($counterpartyRecipient);
        $result = \NovaPoshta\ApiModels\Counterparty::getCounterpartyContactPersons($data);
        $contactPersonRecipient = $result->data[0]->Ref;

        // Для контрагента отправителя получим склад отправки
        $data = new \NovaPoshta\MethodParameters\Address_getWarehouses();
        $data->setCityRef($citySender);
        $result = \NovaPoshta\ApiModels\Address::getWarehouses($data);
        $addressSender = $result->data[5]->Ref;

        // Cоздадим адрес для получателя
        $address = new \NovaPoshta\ApiModels\Address();
        $address->setCounterpartyRef($counterpartyRecipient);
        $address->setBuildingNumber('2/2');
        $address->setFlat('22');
        $address->setNote('Первый подъезд');
        $address->setStreetRef('c55c9056-4148-11dd-9198-001d60451983');
        $result = $address->save();
        $addressRecipient = $result->data[0]->Ref;

        // Теперь получим тип услуги
        $result = \NovaPoshta\ApiModels\Common::getServiceTypes();
        $serviceType = $result->data[3]->Ref; // Выбрали: WarehouseDoors

        // Выбираем плательщика
        $result = \NovaPoshta\ApiModels\Common::getTypesOfPayers();
        $payerType = $result->data[1]->Ref; // Выбрали: Recipient

        // Форму оплаты
        $result = \NovaPoshta\ApiModels\Common::getPaymentForms();
        $paymentMethod = $result->data[1]->Ref; // Выбрали: Cash

        // Тип груза
        $result = \NovaPoshta\ApiModels\Common::getCargoTypes();
        $cargoType = $result->data[0]->Ref; // Выбрали: Cargo

        // Мы выбрали все данные которые нам нужны для создания ЭН. Создаем ЭН:

        // Контрагент отправитель
        $sender = new \NovaPoshta\Models\CounterpartyContact();
        $sender->setCity($citySender)
            ->setRef($counterpartySender)
            ->setAddress($addressSender)
            ->setContact($contactPersonSender)
            ->setPhone('+380660000000');

        // Контрагент получатель
        $recipient = new \NovaPoshta\Models\CounterpartyContact();
        $recipient->setCity($cityRecipient)
            ->setRef($counterpartyRecipient)
            ->setAddress($addressRecipient)
            ->setContact($contactPersonRecipient)
            ->setPhone('+380660000000');

        // Выбираем тип
        $result = \NovaPoshta\ApiModels\Common::getTypesOfPayersForRedelivery();
        $redeliveryPayer = $result->data[1]->Ref;

        // Выбираем тип обратной доставки
        $result = \NovaPoshta\ApiModels\Common::getBackwardDeliveryCargoTypes();
        $redeliveryCargoType = $result->data[1]->Ref;

        // Обратная доставка ценные бумаги
        $backwardDeliveryData = new \NovaPoshta\Models\BackwardDeliveryData();
        $backwardDeliveryData->setPayerType($redeliveryPayer);
        $backwardDeliveryData->setCargoType($redeliveryCargoType);
        $backwardDeliveryData->setRedeliveryString(452);

        $internetDocument = new \NovaPoshta\ApiModels\InternetDocument();
        $internetDocument->setSender($sender)
            ->setRecipient($recipient)
            ->setServiceType($serviceType)
            ->setPayerType($payerType)
            ->setPaymentMethod($paymentMethod)
            ->setCargoType($cargoType)
            ->setWeight(1)
            ->setSeatsAmount(1)
            ->setCost(452)
            ->setDescription('ТЦ')
            ->setDateTime('10.09.2015')
            ->addBackwardDeliveryData($backwardDeliveryData);
        $result = $internetDocument->save();
        $refInternetDocument = $result->data[0]->Ref;

        // Получить ссылку на печать ЭН
        $data = new \NovaPoshta\MethodParameters\InternetDocument_printDocument();
        $data->addDocumentRef($refInternetDocument);
        $data->setCopies(\NovaPoshta\ApiModels\InternetDocument::PRINT_COPIES_FOURFOLD);
        $link = \NovaPoshta\ApiModels\InternetDocument::printDocument($data);

        // После печати ЭН, клеем ЭН на коробку и отправляем груз))

        return $link;
    }
}