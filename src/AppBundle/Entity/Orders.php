<?php

namespace AppBundle\Entity;


/**
 * Orders
 *
 */
class Orders
{
    /**
     * @var int
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var \DateTime
     *
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     */
    private $updatedDate;

    /**
     * @var int
     *
     */
    private $totalQty;

    /**
     * @var string
     *
     */
    private $totalPrice;

    /**
     * @var int
     *
     */
    private $orderUser;

    /**
     * @var string
     */
    private $orderItems;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Orders
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Orders
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     *
     * @return Orders
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Set totalQty
     *
     * @param integer $totalQty
     *
     * @return Orders
     */
    public function setTotalQty($totalQty)
    {
        $this->totalQty = $totalQty;

        return $this;
    }

    /**
     * Get totalQty
     *
     * @return int
     */
    public function getTotalQty()
    {
        return $this->totalQty;
    }

    /**
     * Set totalPrice
     *
     * @param string $totalPrice
     *
     * @return Orders
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return string
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set orderUser
     *
     * @param integer $orderUser
     *
     * @return Orders
     */
    public function setOrderUser(\AppBundle\Entity\User $orderUser)
    {
        $this->orderUser = $orderUser;

        return $this;
    }

    /**
     * Set orderItems
     *
     * @param string $orderItems
     *
     * @return Orders
     */
    public function setOrderItems($orderItems)
    {
        $this->orderItems = $orderItems;

        return $this;
    }

    /**
     * Get orderItems
     *
     * @return string
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * @return mixed
     */
    public function getOrderUser(): User
    {
        return $this->orderUser;
    }
}

