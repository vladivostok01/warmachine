<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KillMail
 *
 * @ORM\Table(name="kill_mail")
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\KillMailRepository")
 */
class KillMail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="War", inversedBy="killmails")
     * @ORM\JoinColumn(name="war_id", referencedColumnName="id")
     */
    private $war;

    /**
     * @ORM\OneToMany(targetEntity="Killer", mappedBy="KillMail", cascade={"persist"})
     */
    private $killers;

    /**
     * @ORM\OneToOne(targetEntity="Victim", mappedBy="killmail", cascade={"persist"})
     */
    private $victim;

    /**
     * @ORM\ManyToOne(targetEntity="SolarSystem", cascade={"persist"})
     * @ORM\JoinColumn(name="solar_id", referencedColumnName="id")
     */
    private $solar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="kill_time", type="datetime")
     */
    private $time;

    public function setSolarSystem($solar)
    {
        $this->solar = $solar;
        return $this;
    }

    public function getSolarSystem()
    {
        return $this->solar;
    }
    public function setKillers($killers)
    {
        $this->killers = $killers;
        return $this;
    }

    public function getKillers()
    {
        return $this->killers;
    }

    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setVictim($victim)
    {
        $this->victim = $victim;
        return $this;
    }

    public function getVictim()
    {
        return $this->victim;
    }


    public function setWar($war){
        $this->war = $war;
        return $this;
    }

    public function getWar(){
        return $this->war;
    }

    public function setId($id)
    {
        $this->id = $id;
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

