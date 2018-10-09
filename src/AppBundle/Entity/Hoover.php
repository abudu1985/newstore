<?php
namespace AppBundle\Entity;


/**
 *  Hoover
 */
class Hoover extends Device
{
    /**
     * @var int
     *
     */
    private $power;

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }

}
