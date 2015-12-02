<?php

namespace NovaPoshta_example;

use NovaPoshta\ApiModels\Counterparty;
use NovaPoshta\MethodParameters\Counterparty_getCounterparties;
use NovaPoshta\MethodParameters\Counterparty_getCounterpartyAddresses;
use NovaPoshta\MethodParameters\Counterparty_getCounterpartyContactPersons;
use NovaPoshta\MethodParameters\Counterparty_getCounterpartyOptions;
use NovaPoshta\MethodParameters\Counterparty_getCounterpartyByEDRPOU;
use NovaPoshta\MethodParameters\Counterparty_cloneLoyaltyCounterpartySender;
use NovaPoshta\MethodParameters\MethodParameters;

class Counterparty_example
{
    public static function save()
    {
        $counterparty = new Counterparty();
        $counterparty->setCounterpartyProperty('Recipient');
        $counterparty->setCityRef('db5c88d0-391c-11dd-90d9-001a92567626');
        $counterparty->setCounterpartyType('PrivatePerson');
        $counterparty->setFirstName('Пилипко');
        $counterparty->setLastName('Вася');
        $counterparty->setMiddleName('Сергеевич');
        $counterparty->setPhone('+380661122333');
        $counterparty->setEmail('test@i.ua');

        return $counterparty->save();
    }

    // третье лицо
    public static function save2()
    {
        $counterparty = new Counterparty();
        $counterparty->setCityRef('8d5a980d-391c-11dd-90d9-001a92567626');
        $counterparty->setCounterpartyType('Organization');
        $counterparty->setEDRPOU('00000000');

        return $counterparty->saveThirdPerson();
    }

    public static function update()
    {
        $counterparty = new Counterparty();
        $counterparty->setRef('eb863d12-ac7d-11e4-a77a-005056887b8d');
        $counterparty->setCounterpartyProperty('Recipient');
        $counterparty->setCityRef('db5c88d0-391c-11dd-90d9-001a92567626');
        $counterparty->setCounterpartyType('PrivatePerson');
        $counterparty->setFirstName('Пилипко');
        $counterparty->setLastName('Петя');
        $counterparty->setMiddleName('Сергеевич');
        $counterparty->setPhone('+380661122333');
        $counterparty->setEmail('test2@i.ua');

        return $counterparty->update();
    }

    // третье лицо
    public static function update2()
    {
        $counterparty = new Counterparty();
        $counterparty->setCityRef('8d5a980d-391c-11dd-90d9-001a92567626');
        $counterparty->setCounterpartyType('Organization');
        $counterparty->setEDRPOU('00000000');

        return $counterparty->updateThirdPerson();
    }

    public static function delete()
    {
        $counterparty = new Counterparty();
        $counterparty->setRef('eb863d12-ac7d-11e4-a77a-005056887b8d');

        return $counterparty->delete();
    }

    public static function getCounterparties()
    {
        $data = new Counterparty_getCounterparties();
        $data->setCounterpartyProperty('Recipient');
        $data->setPage(1);
        $data->setCityRef('8d5a980d-391c-11dd-90d9-001a92567626');
        $data->setFindByString('Петр');
        // или
//        $data->setRef('adcad698-011c-11e5-ad08-005056801333');

        return Counterparty::getCounterparties($data);
    }

    public static function getCounterparties2()
    {
        $data = new MethodParameters();
        $data->CounterpartyProperty = 'Recipient';
        $data->Page = 1;
        $data->CityRef = '8d5a980d-391c-11dd-90d9-001a92567626';
        $data->FindByString = 'Петр';

        return Counterparty::getCounterparties($data);
    }

    public static function getCounterpartyAddresses()
    {
        $data = new Counterparty_getCounterpartyAddresses();
        $data->setRef('512c13ac-1d43-11e4-acce-0050568002cf');

        return Counterparty::getCounterpartyAddresses($data);
    }

    public static function getCounterpartyContactPersons()
    {
        $data = new Counterparty_getCounterpartyContactPersons();
        $data->setRef('512c13ac-1d43-11e4-acce-0050568002cf');
        $data->setPage('1');

        return Counterparty::getCounterpartyContactPersons($data);
    }

    public static function getCounterpartyOptions()
    {
        $data = new Counterparty_getCounterpartyOptions();
        $data->setRef('512c13ac-1d43-11e4-acce-0050568002cf');

        return Counterparty::getCounterpartyOptions($data);
    }

    public static function getCounterpartyByEDRPOU()
    {
        $data = new Counterparty_getCounterpartyByEDRPOU();
        $data->setEDRPOU('0000000');
        $data->setCityRef('db5c88d0-391c-11dd-90d9-001a92567626');

        return Counterparty::getCounterpartyByEDRPOU($data);
    }

    public static function cloneLoyaltyCounterpartySender()
    {
        $data = new Counterparty_cloneLoyaltyCounterpartySender();
        $data->setCityRef('db5c88e0-391c-11dd-90d9-001a92567626');

        return Counterparty::cloneLoyaltyCounterpartySender($data);
    }
}
