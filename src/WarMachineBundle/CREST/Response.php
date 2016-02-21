<?php

namespace WarMachineBundle\CREST;

class Response implements \IteratorAggregate{
	protected $total = 0;

	protected $totalPage = 0;

	protected $items;

	protected $response;

	public function __construct($response){
		$this->response = $response;
		//$this->total = $response->totalCount_str;
		//$this->totalPage = $response->pageCount;
		$this->items = $response->items;
	}

	public function getTotal(){
		return $this->total;
	}

	public function getTotalPage(){
		return $this->totalPage;
	}

	public function getItems(){
		return $this->items;
	}
	public function getIterator(){
		var_dump($this->items);
		return new \ArrayObject($this->items);
	}
	/*
	public function current(){
		return current($this->items);
	}

	public function key(){
		return key($this->items);
	}

	public function next(){
		return next($this->items);
	}

	public function rewind(){
		return rewind($this->items);
	}

	public function valid(){
		return valid($this->items);
	}
	*/
	public function slice($num){
		$resp = clone $this->response;
		$resp->items = array_slice($resp->items, 0, $num);
		return new Response($resp);
	}
}