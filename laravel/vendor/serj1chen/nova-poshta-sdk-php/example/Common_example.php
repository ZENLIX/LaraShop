<?php

namespace NovaPoshta_example;

use NovaPoshta\ApiModels\Common;
use NovaPoshta\MethodParameters\Common_getCargoDescriptionList;
use NovaPoshta\MethodParameters\Common_getTimeIntervals;

class Common_example
{
    public static function getBackwardDeliveryCargoTypes()
    {
        return Common::getBackwardDeliveryCargoTypes();
    }

    public static function getCargoDescriptionList()
    {
        $data = new Common_getCargoDescriptionList();
        $data->setPage(1);
        $data->setFindByString('Шин');

        return Common::getCargoDescriptionList($data);
    }

    public static function getCargoTypes()
    {
        return Common::getCargoTypes();
    }

    public static function getDocumentStatuses()
    {
        return Common::getDocumentStatuses();
    }

    public static function getOwnershipFormsList()
    {
        return Common::getOwnershipFormsList();
    }

    public static function getPalletsList()
    {
        return Common::getPalletsList();
    }

    public static function getPaymentForms()
    {
        return Common::getPaymentForms();
    }

    public static function getServiceTypes()
    {
        return Common::getServiceTypes();
    }

    public static function getTimeIntervals()
    {
        $data = new Common_getTimeIntervals();
        $data->RecipientCityRef = '8d5a980d-391c-11dd-90d9-001a92567626';
        $data->DateTime = '15.03.2015';

        return Common::getTimeIntervals($data);
    }

    public static function getTiresWheelsList()
    {
        return Common::getTiresWheelsList();
    }

    public static function getTraysList()
    {
        return Common::getTraysList();
    }

    public static function getTypesOfCounterparties()
    {
        return Common::getTypesOfCounterparties();
    }

    public static function getTypesOfPayers()
    {
        return Common::getTypesOfPayers();
    }

    public static function getTypesOfPayersForRedelivery()
    {
        return Common::getTypesOfPayersForRedelivery();
    }
}