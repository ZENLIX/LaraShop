<?php

namespace NovaPoshta\Core\Serializer;

use NovaPoshta\Models\DataContainer;
use NovaPoshta\Models\DataContainerResponse;

class DataSerializerXML implements SerializerInterface
{
    public function serializeData(DataContainer $data)
    {
        $xml = new \XmlWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('root');
        $this->recursiveSerialize($xml, $data);
        $xml->endElement();
        $xml->endDocument();

        return $xml->outputMemory();
    }

    public function unserializeData($xml)
    {
        if (empty($xml)) {
            return false;
        }
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xml);
        if (!$xml) {
            $dataContainerResponse = new DataContainerResponse();
            $dataContainerResponse->success = false;
            $dataContainerResponse->errors[] = array('DataSerializerXML.DATA_IS_INVALID');

            return $dataContainerResponse;
        }

        $item = json_decode(json_encode((array)$xml, false), 1);

        $data = $this->arrayToObject($item);
        $this->objectItemToArray($data);

        $data = json_decode(json_encode($data), false);
        $dataContainerResponse = new DataContainerResponse($data);

        if($dataContainerResponse->success == 'true'){
            $dataContainerResponse->success = true;
        } else {
            $dataContainerResponse->success = false;
        }
        $dataContainerResponse->data = (array)$dataContainerResponse->data;
        $dataContainerResponse->warnings = (array)$dataContainerResponse->warnings;
        $dataContainerResponse->info = (array)$dataContainerResponse->info;
        if(is_object($dataContainerResponse->errors)){
            $dataContainerResponse->errors = (array)$dataContainerResponse->errors;
        }

        return $dataContainerResponse;
    }

    private function arrayToObject($d)
    {
        if (is_array($d)) {
            return (object)array_map(array(__CLASS__, __METHOD__), $d);
        } else {
            return $d;
        }
    }

    private function objectItemToArray($data, &$parent = null)
    {
        if (empty($data) || is_string($data)) {
            return false;
        }

        foreach ($data as $key => &$value) {
            if ($key == 'item') {
                $parent = (array)$value;
                if (empty($parent[0])) {
                    $parent = array($value);
                }

                foreach ($parent as $k => &$v) {
                    if (is_object($v) || is_array($v)) {
                        $this->objectItemToArray($v, $v);
                    }
                }
            } elseif (is_object($value) || is_array($value)) {
                $this->objectItemToArray($value, $value);
            }
        }
        return true;
    }

    private function recursiveSerialize(\XMLWriter $xml, $data)
    {
        if (empty($data)) {
            return false;
        }

        foreach ($data as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $xml->startElement(is_int($key) ? 'item' : $key);
                $this->recursiveSerialize($xml, $value);
                $xml->endElement();
                continue;
            }

            $xml->writeElement(
                is_int($key) ? 'item' : $key,
                is_bool($value) ? ($value ? 'true' : 'false') : $value
            );
        }

        return true;
    }
}