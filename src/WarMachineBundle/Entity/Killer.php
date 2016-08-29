<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Killer
 *
 * @ORM\Table(name="killer")
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\KillerRepository")
 */
class Killer
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
     * @ORM\ManyToOne(targetEntity="KillMail", inversedBy="killers")
     * @ORM\JoinColumn(name="kill_id", referencedColumnName="id")
     */
    private $killmail;

    /**
     * @ORM\ManyToOne(targetEntity="Alliance")
     * @ORM\JoinColumn(name="alliance_id", referencedColumnName="id")
     */
    private $alliance;

    /**
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="ship_id", referencedColumnName="id")
     */ 
    private $ship;
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
     * @ORM\JoinColumn(name="weapon_id", referencedColumnName="id")
     */
    private $weapon;

    /**
     * @var bool
     *
     * @ORM\Column(name="final_blow", type="boolean")
     */
    private $finalBlow;

    /**
     * @var int
     *
     * @ORM\Column(name="damage", type="integer")
     */
    private $damage;

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
    public function setWeapon($weapon)
    {
        $this->weapon = $weapon;

        return $this;
    }
    public function setShip($ship)
    {
        $this->ship = $ship;

        return $this;
    }
    public function setKillMail($killmail)
    {
        $this->killmail = $killmail;

        return $this;
    }

    public function getKillMail()
    {
        return $this->killmail;
    }

    public function getShip()
    {
        return $this->ship;
    }
    public function getWeapon()
    {
        return $this->weapon;
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
        return $this->ship;
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
     * Set finalBlow
     *
     * @param boolean $finalBlow
     *
     * @return Killer
     */
    public function setFinalBlow($finalBlow)
    {
        $this->finalBlow = $finalBlow;

        return $this;
    }

    /**
     * Get finalBlow
     *
     * @return bool
     */
    public function getFinalBlow()
    {
        return $this->finalBlow;
    }

    /**
     * Set damage
     *
     * @param integer $damage
     *
     * @return Killer
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

