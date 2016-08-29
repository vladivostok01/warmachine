<?php

namespace WarMachineBundle\CREST;

class WarMachine{

	public function __construct($client){

		$this->client = $client;

	}

	public function getWar($id)
	{
		return $this->client->war($id);
	}

	public function getKillMails($war)
	{
		return $this->client->request($war->killmails);
	}

	public function request($href)
	{
		return $this->client->request($href);
	}

	public function getWarSummary($id){

		$war = $this->client->war($id);
		return $
		$killmail = $this->client->request($war->killmails);
		$kills = array();
		//print_r($killmail);
		//die();
		foreach($killmail->items as $mail){
			$kills[] = $this->client->request($mail->href);
		}

		$war->kills = $kills;
		return $war;

	}

}