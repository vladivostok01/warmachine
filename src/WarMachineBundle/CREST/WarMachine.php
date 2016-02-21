<?php

namespace WarMachineBundle\CREST;

class WarMachine{

	public function __construct($client){

		$this->client = $client;

	}

	public function getWarSummary(){

		$wars = $this->client->wars();
		$wars = array_slice($wars->items, 0, 10);
		$details = array();

		foreach($wars as $war){
			$details[] = $this->client->request($war->href);
		}

		return $details;

	}

}