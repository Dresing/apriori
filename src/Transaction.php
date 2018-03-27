<?php 

namespace Apriori;

use Apriori\Apriori;
use Apriori\Itemset;

/**
*  Base transaction for apriori
*/
class Transaction
{
	private $xactSet;
	private $uniqueItems;


	public function __construct(Itemset $xactSet)
	{
		$this->xactSet = $xactSet;
	}

	public function getItemset()
	{
		return $this->xactSet;
	}
}


 ?>