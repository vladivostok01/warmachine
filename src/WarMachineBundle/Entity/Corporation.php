<?php

namespace WarMachineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Corporation
 *
 * @ORM\Entity(repositoryClass="WarMachineBundle\Repository\CorporationRepository")
 */
class Corporation extends Actor
{
    protected $type = 'corporation';
}