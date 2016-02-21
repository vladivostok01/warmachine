<?php

namespace WarMachineBundle\Tests\CREST;

use WarMachineBundle\CREST\Client;

class ClientTest extends \PHPUnit_Framework_TestCase{
	
	const URL = 'https://public-crest.eveonline.com/';
	
	public function testWars(){

		$client = new Client(self::URL);

		echo $client->wars();

	}

}