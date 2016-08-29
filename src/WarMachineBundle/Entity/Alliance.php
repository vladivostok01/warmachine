<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Alliance 
 *
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\AllianceRepository")
 */
class Alliance extends Actor
{
    protected $type = 'alliance';
}

