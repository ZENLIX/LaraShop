<?php

namespace NovaPoshta_example;


use NovaPoshta\ApiModels\Common;
use NovaPoshta\ApiModels\InternetDocument;
use NovaPoshta\MethodParameters\Common_getTimeIntervals;
use NovaPoshta\Models\CounterpartyContact;

class Batch_example
{
    public static function butch()
    {
        $dataArray = array(
            'getBackwardDeliveryCargoTypes' => null,
            'getCargoDescriptionList' => null,
            'getCargoTypes' => null,
            'getDocumentStatuses' => null,
            'getOwnershipFormsList' => null,
            'getPalletsList' => null,
            'getPaymentForms' => null,
            'getServiceTypes' => null,
            'getTimeIntervals' => null,
            'getTiresWheelsList' => null,
            'getTraysList' => null,
            'getTypesOfCounterparties' => null,
            'getTypesOfPayers' => null,
            'getTypesOfPayersForRedelivery' => null,
        );


        Common::isBatch();

        $dataArray['getBackwardDeliveryCargoTypes'] = Common::getBackwardDeliveryCargoTypes();
        $dataArray['getCargoDescriptionList'] = Common::getCargoDescriptionList();
        $dataArray['getCargoTypes'] = Common::getCargoTypes();
        $dataArray['getDocumentStatuses'] = Common::getDocumentStatuses();
        $dataArray['getOwnershipFormsList'] = Common::getOwnershipFormsList();
        $dataArray['getPalletsList'] = Common::getPalletsList();
        $dataArray['getPaymentForms'] = Common::getPaymentForms();
        $dataArray['getServiceTypes'] = Common::getServiceTypes();

        $data = new Common_getTimeIntervals();
        $data->RecipientCityRef = '8d5a980d-391c-11dd-90d9-001a92567626';
        $data->DateTime = '15.03.2015';
        $dataArray['getTimeIntervals'] = Common::getTimeIntervals($data);

        $dataArray['getTiresWheelsList'] = Common::getTiresWheelsList();
        $dataArray['getTraysList'] = Common::getTraysList();
        $dataArray['getTypesOfCounterparties'] = Common::getTypesOfCounterparties();
        $dataArray['getTypesOfPayers'] = Common::getTypesOfPayers();
        $dataArray['getTypesOfPayersForRedelivery'] = Common::getTypesOfPayersForRedelivery();

        $result = Common::getResponseBatch();

        $dataResult = array(
            'attr' => $dataArray,
            'dataResult' => $result,
        );

        return $dataResult;
    }

    public static function butch2()
    {
        $dataArray = array(
            'document1' => null,
            'document2' => null,
        );

        Common::isBatch();


        $sender = new CounterpartyContact();
        $sender->setCity('8d5a980d-391c-11dd-90d9-001a92567626');
        $sender->setRef('f867c762-e66a-11e3-8c4a-0050568002cf');
        $sender->setAddress('1ec09d88-e1c2-11e3-8c4a-0050568002cf');
        $sender->setContact('e23f313c-e67a-11e3-8c4a-0050568002cf');
        $sender->setPhone('+380660000000');

        $recipient = new CounterpartyContact();
        $recipient->setCity('db5c88de-391c-11dd-90d9-001a92567626');
        $recipient->setRef('7da56a9c-f205-11e3-8c4a-0050568002cf');
        $recipient->setAddress('daec7561-b457-11e4-a77a-005056887b8d');
        $recipient->setContact('57065334-f211-11e3-8c4a-0050568002cf');
        $recipient->setPhone('+380660000001');

        $internetDocument = new InternetDocument();
        $internetDocument->setSender($sender);
        $internetDocument->setRecipient($recipient);
        $internetDocument->setServiceType('WarehouseDoors');
        $internetDocument->setPayerType('Recipient');
        $internetDocument->setPaymentMethod('Cash');
        $internetDocument->setCargoType('Cargo');
        $internetDocument->setWeight('31');
        $internetDocument->setVolumeGeneral('0.002');
        $internetDocument->setSeatsAmount('2');
        $internetDocument->setCost('2');
        $internetDocument->setDescription(' fd  fsf2');
        $internetDocument->setDateTime('10.04.2015');
        $internetDocument->setPreferredDeliveryDate('20.04.2015');
        $internetDocument->setTimeInterval('CityDeliveryTimeInterval2');
        $internetDocument->setPackingNumber('55');
        $internetDocument->setInfoRegClientBarcodes('55552');
        $internetDocument->setSaturdayDelivery('true');
        $internetDocument->setNumberOfFloorsLifting('12');
        $internetDocument->setAccompanyingDocuments('Великий кошик');
        $internetDocument->setAdditionalInformation('Скло');

        $dataArray['document1'] = $internetDocument->save();


        $sender = new CounterpartyContact();
        $sender->setCity('8d5a980d-391c-11dd-90d9-001a92567626');
        $sender->setRef('f867c762-e66a-11e3-8c4a-0050568002cf');
        $sender->setAddress('1ec09d88-e1c2-11e3-8c4a-0050568002cf');
        $sender->setContact('e23f313c-e67a-11e3-8c4a-0050568002cf');
        $sender->setPhone('+380660000000');

        $recipient = new CounterpartyContact();
        $recipient->setCity('db5c88de-391c-11dd-90d9-001a92567626');
        $recipient->setRef('7da56a9c-f205-11e3-8c4a-0050568002cf');
        $recipient->setAddress('daec7561-b457-11e4-a77a-005056887b8d');
        $recipient->setContact('57065334-f211-11e3-8c4a-0050568002cf');
        $recipient->setPhone('+380660000001');

        $internetDocument = new InternetDocument();
        $internetDocument->setSender($sender);
        $internetDocument->setRecipient($recipient);
        $internetDocument->setServiceType('WarehouseDoors');
        $internetDocument->setPayerType('Recipient');
        $internetDocument->setPaymentMethod('Cash');
        $internetDocument->setCargoType('Cargo');
        $internetDocument->setWeight('31');
        $internetDocument->setVolumeGeneral('0.002');
        $internetDocument->setSeatsAmount('2');
        $internetDocument->setCost('2');
        $internetDocument->setDescription(' fd  fsf2');
        $internetDocument->setDateTime('10.05.2015');
        $internetDocument->setPreferredDeliveryDate('20.05.2015');
        $internetDocument->setTimeInterval('CityDeliveryTimeInterval2');
        $internetDocument->setPackingNumber('55');
        $internetDocument->setInfoRegClientBarcodes('55552');
        $internetDocument->setSaturdayDelivery(true);
        $internetDocument->setNumberOfFloorsLifting('12');
        $internetDocument->setAccompanyingDocuments('Великий кошик');
        $internetDocument->setAdditionalInformation('Скло');

        $dataArray['document2'] = $internetDocument->save();


        $result = Common::getResponseBatch();

        $dataResult = array(
            'attr' => $dataArray,
            'dataResult' => $result,
        );

        return $dataResult;
    }
}