<?php

namespace WarMachineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WarMachineBundle\CREST\Client;

class DefaultController extends Controller
{
    public function indexAction()
    {
    		$client = $this->get('crest.client');

    		$machine = $this->get('crest.warmachine');

    		// PH $wars = $machine->war(434424);
    		// CD $wars = $machine->war(487960);
    		// Duckhunter
    		$wars = $machine->getWarSummary(496378);

    		echo "<pre>";
    		print_r($wars);
        return $this->render('WarMachineBundle:CREST:warSummary.html.twig', array('wars' => array()));
    }
}
