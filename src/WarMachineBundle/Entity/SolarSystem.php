<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SolarSystem
 *
 * @ORM\Table(name="solar_system")
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\SolarSystemRepository")
 */
class SolarSystem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="href", type="string", length=255)
     */
    private $href;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return SolarSystem
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
     * Set href
     *
     * @param string $href
     *
     * @return SolarSystem
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }
}

