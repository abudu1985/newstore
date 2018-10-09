<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;


class Device
{
    /**
     * @var int
     *
     */
    private $id;

    /**
     * @var string
     */
    private $color;


    /**
     * @var float
     *
     */
    private $price;

    /**
     * @var string
     *
     */
    private $firm;

    /**
     * @param string $firm
     */
    public function setFirm($firm)
    {
        $this->firm = $firm;
    }

    /**
     * @return string
     */
    public function getFirm()
    {
        return $this->firm;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

}

