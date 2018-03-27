<?php 

namespace Apriori;

use Apriori\Itemset;


/**
* Itemset class
*/
class Itemset implements \Iterator
{
	private $position;
	private $items;
	private $support;  


	public function __construct($items = [], $sorted = false) {


		$this->position = 0;
		$this->items = $items;
		$this->support = 0;

		if (!$sorted)
		{
			$this->sort();
		}
	}
	public function getSubsets()
	{
		$subsets = [];

		foreach ($this as $index => $value)
		{
			$subsets[] = new Itemset(array_filter($this->items, function ($item) use ($value) {
				return ($item->id() != $value->id());
			}));
		}

		return $subsets;
	}

	public static function equal($firstSet, $secondSet)
	{
		if ($firstSet->size() != $secondSet->size())
		{
			return false;
		}

		//Don't compare the last element
		for ($i = 0; $i < $firstSet->size(); $i++)
		{
			if ($firstSet->get($i) != $secondSet->get($i))
			{
				return false;
			} 
		}

		return true;
	}
	public static function join(Itemset $firstSet, Itemset $secondSet)
	{
		$items = [];

		// Take all elements from the first set exclude the last
		for ($i = 0; $i < $firstSet->size()-1; $i++)
		{
			$items[] = $firstSet->get($i);
		}	

		// Avoid sorting array by comparing the last elements before inserting.
		if ($firstSet->get($firstSet->size()-1) <= $secondSet->get($secondSet->size()-1))
		{
			$items[] = $firstSet->get($firstSet->size()-1);
			$items[] = $secondSet->get($secondSet->size()-1);
		}
		else
		{
			$items[] = $secondSet->get($secondSet->size()-1);		
			$items[] = $firstSet->get($firstSet->size()-1);
		}

		//No need to sort
		return new Itemset($items, true);

	}

	public function canJoin(Itemset $secondSet)
	{
		if ($this->size() != $secondSet->size())
		{
			return false;
		}

		//Don't compare the last element
		for ($i = 0; $i < $this->size()-1; $i++)
		{
			if ($this->get($i) != $secondSet->get($i))
			{
				return false;
			} 
		}

		return true;
	}

	public function addSupport()
	{
		$this->support++;
	}

	public function getSupport()
	{
		return $this->support;
	}


	public function get($index)
	{
		if ($index >= $this->size())
		{
			throw new \OutOfBoundsException('Invalid index in Apriori\Itemset');
		}
		return $this->items[$index];
	}

	public function size() 
	{
		return count($this->items);
	}

	public function rewind() {
		$this->position = 0;
	}

	public function current() {
		return $this->items[$this->position];
	}

	public function key() {
		return $this->position;
	}

	public function next() {
		++$this->position;
	}

	public function valid() {
		return isset($this->items[$this->position]);
	}	

	public function sort()
	{
		usort($this->items, function ($a, $b)
		{
			if ($a == $b) {
				return 0;
			}
			return ($a < $b) ? -1 : 1;
		});
	}
}

?>