<?php
namespace AppBundle\Entity;

/**
 *  Mobile
 */
class Mobile extends Device
{
    /**
     * @var int
     *
     */
    private $memory;

    /**
     * @var int
     *
     */
    private $ram;

    /**
     * @return mixed
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param mixed $memory
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }

    /**
     * @return mixed
     */
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * @param mixed $ram
     */
    public function setRam($ram)
    {
        $this->ram = $ram;
    }

}
