<?php


namespace NovaPoshta\Models;

use NovaPoshta\Core\BaseModel;

/**
 * Параметры груза
 *
 * Class OptionsSeat
 * @package NovaPoshta\Models
 * @property float volumetricVolume
 * @property float volumetricWidth
 * @property float volumetricLength
 * @property float volumetricHeight
 * @property float weight
 */
class OptionsSeat extends BaseModel
{
    /**
     * Устанавливает объем
     *
     * @param float $value
     * @return $this
     */
    public function setVolumetricVolume($value)
    {
        $this->volumetricVolume = $value;
        return $this;
    }

    /**
     * Возвращает объем
     *
     * @return float
     */
    public function getVolumetricVolume()
    {
        return $this->volumetricVolume;
    }

    /**
     * Устанавливает ширину
     *
     * @param float $value
     * @return $this
     */
    public function setVolumetricWidth($value)
    {
        $this->volumetricWidth = $value;
        return $this;
    }

    /**
     * Возвращает ширину
     *
     * @return float
     */
    public function getVolumetricWidth()
    {
        return $this->volumetricWidth;
    }

    /**
     * Устанавливает длину
     *
     * @param float $value
     * @return $this
     */
    public function setVolumetricLength($value)
    {
        $this->volumetricLength = $value;
        return $this;
    }

    /**
     * Возвращает длину
     *
     * @return float
     */
    public function getVolumetricLength()
    {
        return $this->volumetricLength;
    }

    /**
     * Устанавливает высоту
     *
     * @param float $value
     * @return $this
     */
    public function setVolumetricHeight($value)
    {
        $this->volumetricHeight = $value;
        return $this;
    }

    /**
     * Возвращает высоту
     *
     * @return float
     */
    public function getVolumetricHeight()
    {
        return $this->volumetricHeight;
    }

    /**
     * Устанавливает вес
     *
     * @param float $value
     * @return $this
     */
    public function setWeight($value)
    {
        $this->weight = $value;
        return $this;
    }

    /**
     * Возвращает вес
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }
}