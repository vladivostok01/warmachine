<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loss
 *
 * @ORM\Table(name="loss")
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\LossRepository")
 */
class Loss
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var bool
     *
     * @ORM\Column(name="destroyed", type="boolean")
     */
    private $destroyed;

    /**
     * @ORM\ManyToOne(targetEntity="Victim", inversedBy="losses")
     * @ORM\JoinColumn(name="victim_id", referencedColumnName="id")
     */
    private $victim;

    /**
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;
    
    public function setVictim($victim)
    {
        $this->victim = $victim;

        return $this;
    }
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getVictim()
    {
        return $this->victim;
    }


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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Loss
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set destroyed
     *
     * @param boolean $destroyed
     *
     * @return Loss
     */
    public function setDestroyed($destroyed)
    {
        $this->destroyed = $destroyed;

        return $this;
    }

    /**
     * Get destroyed
     *
     * @return bool
     */
    public function getDestroyed()
    {
        return $this->destroyed;
    }
}

