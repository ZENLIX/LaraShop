<?php

namespace NovaPoshta\Core\Serializer;

use NovaPoshta\Models\DataContainer;

interface SerializerInterface
{
    /**
     * @param DataContainer $data
     * @return mixed
     */
    public function serializeData(DataContainer $data);

    /**
     *
     * @param string $data
     * @return mixed
     */
    public function unserializeData($data);
}