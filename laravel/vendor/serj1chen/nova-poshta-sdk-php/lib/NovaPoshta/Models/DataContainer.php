<?php

namespace NovaPoshta\Models;

use NovaPoshta\Core\BaseModel;

/**
 * Объект для формирования запроса
 *
 * Class DataContainer
 * @package NovaPoshta\Models
 */
class DataContainer extends BaseModel
{
    public $id;
    public $modelName;
    public $calledMethod;
    public $apiKey;
    public $methodProperties;
    public $language;
}