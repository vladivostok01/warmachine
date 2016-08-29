<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WarActor
 *
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\WarActorRepository")
 */
class WarActor{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Actor", cascade={"persist"})
     * @ORM\JoinColumn(name="actor_id", referencedColumnName="id")
     */
    private $actor;

    /**
     * @var int
     *
     * @ORM\Column(name="isk", type="integer")
     */
    private $isk;

    /**
     * @var int
     *
     * @ORM\Column(name="ships", type="integer")
     */
    private $ships;


    public function setIsk($isk){
        $this->isk = $isk;
        return $this;
    }

    public function getIsk(){
        return $this->isk;
    }

    public function getShips(){
        return $this->ships;
    }

    public function setShips($ships){
        $this->ships = $ships;
        return $this;
    }

    public function setActor($actor)
    {
        $this->actor = $actor;
        return $this;
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


}

