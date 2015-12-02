<?php

namespace NovaPoshta_example;

use NovaPoshta\ApiModels\Address;
use NovaPoshta\MethodParameters\Address_getStreet;
use NovaPoshta\MethodParameters\Address_getWarehouses;
use NovaPoshta\MethodParameters\Address_getCities;
use NovaPoshta\MethodParameters\Address_getAreas;

class Address_example
{
    public static function save()
    {
        $address = new Address();
        $address->setCounterpartyRef('2718756a-b39b-11e4-a77a-005056887b8d');
        $address->setBuildingNumber('2/2');
        $address->setFlat('22');
        $address->setNote('Первый подъезд');
        $address->setStreetRef('c55c9056-4148-11dd-9198-001d60451983');

        return $address->save();
    }

    public static function update()
    {
        $address = new Address();
        $address->setRef('e29115c8-6f59-11e4-acce-0050568002cf');
        $address->setCounterpartyRef('2718756a-b39b-11e4-a77a-005056887b8d');
        $address->setBuildingNumber('92');
        $address->setFlat('22');
        $address->setNote('Первый');
        $address->setStreetRef('c55c9056-4148-11dd-9198-001d60451983');

        return $address->update();
    }

    public static function delete()
    {
        $address = new Address();
        $address->setRef('e29115c8-6f59-11e4-acce-0050568002cf');

        return $address->delete();
    }

    public static function getCities()
    {
        $data = new Address_getCities();
        $data->setRef('db5c896a-391c-11dd-90d9-001a92567626');
        $data->setPage(1);
        $data->setFindByString('Пол');

        return Address::getCities($data);
    }

    public static function getStreet()
    {
        $data = new Address_getStreet();
        $data->setCityRef('8d5a980d-391c-11dd-90d9-001a92567626');
        $data->setFindByString('Авт');
        $data->setPage(1);

        return Address::getStreet($data);
    }

    public static function getWarehouses()
    {
        $data = new Address_getWarehouses();
        $data->setCityRef('ebc0eda9-93ec-11e3-b441-0050568002cf');
        $data->setPage(1);

        return Address::getWarehouses($data);
    }

    public static function getAreas()
    {
        $data = new Address_getAreas();
        $data->setRef('7150813d-9b87-11de-822f-000c2965ae0e');
        $data->setPage(1);

        return Address::getAreas($data);
    }
}
