<?php

namespace WarMachineBundle\CREST;

class Client{
	
	const WARS = 'wars/';
	
	const CORPS = 'corporations/';

	protected $url = null;

	public function __construct($url){
		$this->url = $url;
	}

	public function wars(){
		return $this->request(self::WARS);
	}

	public function war($id){
		return $this->request(self::WARS.$id);
	}

	public function corps(){
		return $this->request(self::CORPS);
	}

	public function corp($id){
		return $this->request(self::CORPS.$id);
	}

	public function request($frag){
		if(eregi('^http', $frag)){
			$endpoint = $frag;
		} else {
			$endpoint = $this->url.$frag;
		}
		//could use something more sophisticated like Guzzle when the need arises.
		return json_decode(file_get_contents($endpoint));
	}

}