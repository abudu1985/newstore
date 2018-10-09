<?php
namespace AppBundle\Entity;

/**
 * Freezer
 */
class Freezer extends Device
{
    /**
     * @var int
     *
     */
    private $temperature;

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param mixed $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

}
