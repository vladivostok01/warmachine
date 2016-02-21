<?php

namespace WarMachineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WarMachineBundle\CREST\Client;

class DefaultController extends Controller
{
    public function indexAction()
    {
    		$machine = $this->get('crest.warmachine');

    		$wars = $machine->getWarSummary();

        return $this->render('WarMachineBundle:CREST:warSummary.html.twig', array('wars' => $wars));
    }
}
