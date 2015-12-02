<?php

namespace NovaPoshta\Core\Serializer;

use NovaPoshta\Models\DataContainer;
use NovaPoshta\Models\DataContainerResponse;


class DataSerializerJSON implements SerializerInterface
{
    public function serializeData(DataContainer $data)
    {
        $json = json_encode($data);

        return $json;
    }

    public function unserializeData($json)
    {
        $data = (array)json_decode($json);
        if (json_last_error() != JSON_ERROR_NONE) {
            $dataContainerResponse = new DataContainerResponse();
            $dataContainerResponse->success = false;
            $dataContainerResponse->errors[] = array('DataSerializerJSON.DATA_IS_INVALID');

            return $dataContainerResponse;
        }

        $data = json_decode(json_encode($data), false);
        $data->errors = (array)$data->errors;
        $dataContainerResponse = new DataContainerResponse($data);

        return $dataContainerResponse;
    }
}