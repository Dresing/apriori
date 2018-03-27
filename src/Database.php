<?php 

namespace Apriori;

use Apriori\Transaction;


class Database implements \Iterator
{
	private $position = 0;
	private $transactions = [

	];  



	public function __construct($xact = []) {
		$this->transactions = $xact;
		$this->position = 0;
	}

	public function rewind() {
		$this->position = 0;
	}

	public function current() {
		return $this->transactions[$this->position];
	}

	public function key() {
		return $this->position;
	}

	public function next() {
		++$this->position;
	}

	public function valid() {
		return isset($this->transactions[$this->position]);
	}        	
}
?>
