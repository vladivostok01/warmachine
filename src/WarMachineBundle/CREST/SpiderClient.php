<?php

namespace WarMachineBundle\CREST;

class SpiderClient extends Client
{


	public function request($uri)
	{
		$response = (array) parent::request($uri);

		$iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($response));
		foreach($iterator as $key => $value){
			if(strpos($value, 'http') !== false){
				$obj = $iterator->getSubIterator();
				try{
					$obj->offsetSet($key.'_child', parent::request($value));
				}
				catch(\Exception $e){
					$obj->offsetSet($key.'_child', 'exception');
				}
			}
		}
		return $response;
	}
}