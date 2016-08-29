<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Victim
 *
 * @ORM\Table(name="victim")
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\VictimRepository")
 */
class Victim
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
     * @ORM\OneToOne(targetEntity="KillMail", inversedBy="victim")
     * @ORM\JoinColumn(name="kill_id", referencedColumnName="id")
     */
    private $killmail;

    /**
     * @ORM\ManyToOne(targetEntity="Alliance")
     * @ORM\JoinColumn(name="alliance_id", referencedColumnName="id")
     */
    private $alliance;

    /**
     * @ORM\ManyToOne(targetEntity="Corporation")
     * @ORM\JoinColumn(name="corp_id", referencedColumnName="id")
     */
    private $corporation;
    /**
     * @ORM\ManyToOne(targetEntity="Actor")
     * @ORM\JoinColumn(name="char_id", referencedColumnName="id")
     */
    private $character;

    /**
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="ship_id", referencedColumnName="id")
     */
    private $ship;

    /**
     * @ORM\OneToMany(targetEntity="Loss", mappedBy="victim")
     */
    private $losses;

    /**
     * @var int
     *
     * @ORM\Column(name="damage", type="integer")
     */
    private $damage;

    public function setLosses($losses)
    {
        $this->losses = $losses;
        return $this;
    }

    public function getLosses()
    {
        return $this->losses;
    }

    public function setShip($ship)
    {
        $this->ship = $ship;
        return $this;
    }

    public function setAlliance($alliance)
    {
        $this->alliance = $alliance;

        return $this;
    }
    
    public function setCorporation($corporation)
    {
        $this->corporation = $corporation;

        return $this;
    }
    
    public function setCharacter($character)
    {
        $this->character = $character;

        return $this;
    }
    
    public function setKillMail($killmail)
    {
        $this->killmail = $killmail;

        return $this;
    }

    public function getShip()
    {
        return $this->ship;
    }

    public function getKillMail()
    {
        return $this->killmail;
    }

    public function getCharacter()
    {
        return $this->character;
    }
    public function getAlliance()
    {
        return $this->alliance;
    }
    public function getCorporation()
    {
        return $this->corporation;
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
     * Set damage
     *
     * @param integer $damage
     *
     * @return Victim
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * Get damage
     *
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }
}

