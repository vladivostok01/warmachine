<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * War
 *
 * @ORM\Table(name="war")
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\WarRepository")
 */
class War
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="started", type="datetime")
     */
    private $started;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finished", type="datetime", nullable=true)
     */
    private $finished;

    /**
     * @var bool
     *
     * @ORM\Column(name="open_for_allies", type="boolean")
     */
    private $openForAllies;

    /**
     * @var int
     *
     * @ORM\Column(name="allyCount", type="integer")
     */
    private $allyCount;

    /**
     * @var bool
     *
     * @ORM\Column(name="mutual", type="boolean")
     */
    private $mutual;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="declared", type="datetime")
     */
    private $declared;

    /**
     * @ORM\OneToOne(targetEntity="WarActor", inversedBy="war", cascade={"persist"})
     * @ORM\JoinColumn(name="aggressor_id", referencedColumnName="id")
     */
    private $aggressor;

    /**
     * @ORM\OneToOne(targetEntity="WarActor", inversedBy="war", cascade={"persist"})
     * @ORM\JoinColumn(name="defender_id", referencedColumnName="id")
     */
    private $defender;

    /** 
     * @ORM\OneToMany(targetEntity="KillMail", mappedBy="war", cascade={"persist"})
     */
    private $killmails;
    
    public function setKillMails($killmails)
    {
        $this->killmails = $killmails;
        return $this;
    }

    public function getKillMails()
    {
        return $this->killmails;
    }

    public function setId($id)
    {
        $this->id = $id;
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
     * Set started
     *
     * @param \DateTime $started
     *
     * @return War
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    /**
     * Get started
     *
     * @return \DateTime
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set declared
     *
     * @param \DateTime $declared
     *
     * @return War
     */
    public function setDeclared($declared)
    {
        $this->declared = $declared;

        return $this;
    }

    /**
     * Get declared
     *
     * @return \DateTime
     */
    public function getDeclared()
    {
        return $this->declared;
    }
    /**
     * Set finished
     *
     * @param \DateTime $finished
     *
     * @return WarDummy
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return \DateTime
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set openForAllies
     *
     * @param boolean $openForAllies
     *
     * @return WarDummy
     */
    public function setOpenForAllies($openForAllies)
    {
        $this->openForAllies = $openForAllies;

        return $this;
    }

    /**
     * Get openForAllies
     *
     * @return bool
     */
    public function getOpenForAllies()
    {
        return $this->openForAllies;
    }

    /**
     * Set allyCount
     *
     * @param integer $allyCount
     *
     * @return WarDummy
     */
    public function setAllyCount($allyCount)
    {
        $this->allyCount = $allyCount;

        return $this;
    }

    /**
     * Get allyCount
     *
     * @return int
     */
    public function getAllyCount()
    {
        return $this->allyCount;
    }

    /**
     * Set mutual
     *
     * @param boolean $mutual
     *
     * @return WarDummy
     */
    public function setMutual($mutual)
    {
        $this->mutual = $mutual;

        return $this;
    }

    /**
     * Get mutual
     *
     * @return bool
     */
    public function getMutual()
    {
        return $this->mutual;
    }

    public function setAggressor($aggressor)
    {
        $this->aggressor = $aggressor;

        return $this;
    }

    public function setDefender($defender)
    {
        $this->defender = $defender;

        return $this;
    }

    public function getAggressor()
    {
        return $this->aggressor;
    }
    public function getDefender()
    {
        return $this->defender;
    }
}

