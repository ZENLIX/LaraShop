<?php

namespace NovaPoshta_example;

use NovaPoshta\ApiModels\ScanSheet;

class ScanSheet_example
{
    public static function save()
    {
        $scanSheets = array('70ec0f61-bf6b-11e4-a77a-005056887b8d', '70ec0f33-bf6b-11e4-a77a-005056887b8d');

        $scanSheet = new ScanSheet();
        $scanSheet->setDate('16.06.2015');

        $scanSheet->setDocumentRefs($scanSheets);

        // или

        $scanSheet->addDocumentRef('70ec0f2a-bf6b-11e4-a77a-005056887b8d');
        $scanSheet->addDocumentRef('70ec0f42-bf6b-11e4-a77a-005056887b8d');

        return $scanSheet->save();
    }

    public static function update()
    {
        $scanSheet = new ScanSheet();
        $scanSheet->setRef('1c65213d-c00b-11e4-ac12-005056801333');
        $scanSheet->setDate('16.03.2015');
        $scanSheet->addDocumentRef('70ec0dfd-bf6b-11e4-a77a-005056887b8d');
        $scanSheet->addDocumentRef('9d014a5e-bf43-11e4-a77a-005056887b8d');

        return $scanSheet->update();
    }

    public static function delete()
    {
        $scanSheet = new ScanSheet();
        $scanSheet->setRef('9d868cfe-012e-11e5-ad08-005056801333');

        return $scanSheet->delete();
    }

    public static function removeDocuments()
    {
        $arrayDocuments = array('70ec0f2a-bf6b-11e4-a77a-005056887b8d', '70ec0f33-bf6b-11e4-a77a-005056887b8d');

        $data = new \NovaPoshta\MethodParameters\ScanSheet_removeDocuments();

        $data->setDocumentRefs($arrayDocuments);

        // или

        $data->addDocumentRef('70ec0f42-bf6b-11e4-a77a-005056887b8d');
        $data->addDocumentRef('70ec0f61-bf6b-11e4-a77a-005056887b8d');

        return ScanSheet::removeDocuments($data);
    }

    public static function getScanSheet()
    {
        $data = new \NovaPoshta\MethodParameters\ScanSheet_getScanSheet();
        $data->setRef('9120e925-c00c-11e4-ac12-005056801333');

        return ScanSheet::getScanSheet($data);
    }

    public static function getScanSheetList()
    {
        return ScanSheet::getScanSheetList();
    }

    public static function printScanSheet()
    {
        $data = new \NovaPoshta\MethodParameters\ScanSheet_printScanSheet();

        $data->addDocumentRef('39d5aadd-c5ed-11e4-ac12-005056801333');
        // или
        // $data->setDocumentRefs(array('39d5aadd-c5ed-11e4-ac12-005056801333'));
        // или
        // $data->addNumber('105-0002898');

        $data->setType(ScanSheet::PRINT_TYPE_PDF);

        return ScanSheet::printScanSheet($data);
    }
}

