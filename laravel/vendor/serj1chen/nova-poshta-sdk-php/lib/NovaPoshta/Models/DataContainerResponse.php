<?php

namespace NovaPoshta\Models;

use NovaPoshta\Core\BaseModel;

/**
 * Контейнер с ответом сервера
 *
 * Class DataContainerResponse
 * @package NovaPoshta\Models
 */
class DataContainerResponse extends BaseModel
{
    public $id;
    public $success;
    public $data = array();
    public $errors = array();
    public $warnings = array();
    public $info = array();

    public function __construct(\stdClass $data = null)
    {
        parent::__construct();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}