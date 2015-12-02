<?php

namespace NovaPoshta\Models;

use NovaPoshta\Core\BaseModel;

/**
 * Груз
 *
 * Class Cargo
 * @package NovaPoshta\Models
 * @property string CargoDescription
 * @property int    Amount
 */
class Cargo extends BaseModel
{
    /**
     * Устанавливает реф груза
     *
     * @param string $value
     * @return $this
     */
    public function setCargoDescription($value)
    {
        $this->CargoDescription = $value;
        return $this;
    }

    /**
     * Возвращает реф груза
     *
     * @return string
     */
    public function getCargoDescription()
    {
        return $this->CargoDescription;
    }

    /**
     * Устанавливает количество груза
     *
     * @param int $value
     * @return $this
     */
    public function setAmount($value)
    {
        $this->Amount = $value;
        return $this;
    }

    /**
     * Возвращает количество груза
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->Amount;
    }
}