<?php

namespace NovaPoshta_example;

use NovaPoshta\ApiModels\ContactPerson;

class ContactPerson_example
{
    public static function save()
    {
        $contactPerson = new ContactPerson();
        $contactPerson->setCounterpartyRef('2718756a-b39b-11e4-a77a-005056887b8d');
        $contactPerson->setFirstName('Пандан');
        $contactPerson->setLastName('Джедай');
        $contactPerson->setMiddleName('Джедаевич');
        $contactPerson->setPhone('380660000000');
        $contactPerson->setEmail('test@i.ua');

        return $contactPerson->save();
    }

    public static function update()
    {
        $contactPerson = new ContactPerson();
        $contactPerson->setRef('6ba7314c-b543-11e4-a77a-005056887b8d');
        $contactPerson->setCounterpartyRef('2718756a-b39b-11e4-a77a-005056887b8d');
        $contactPerson->setFirstName('Панданюк');
        $contactPerson->setLastName('Джедай');
        $contactPerson->setMiddleName('Джедаевич');
        $contactPerson->setPhone('380660000000');
        $contactPerson->setEmail('test@i.ua');

        return $contactPerson->update();
    }

    public static function delete()
    {
        $contactPerson = new ContactPerson();
        $contactPerson->setRef('6ba7314c-b543-11e4-a77a-005056887b8d');

        return $contactPerson->delete();
    }
}
