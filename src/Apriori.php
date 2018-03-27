<?php
namespace Apriori;

use Apriori\Item;
use Apriori\Itemset;

/**
* 
*/
class Apriori
{

	// Contains all the itemsets
	private $alphabet;
	private $threshold;
	private $database;
	private $results;
	private $candidate;

	/**
	*	Given an array of objects implementing the Apriori\Item interface
	*	the constructor wraps them in Apriori\Itemsets of size one.
	*/
	function __construct()
	{
		// No sorting is required for size one itemsets, denoted by second argument.
		$this->alphabet = [];
		$this->threshold = 2;
		$this->database = null;
		$this->results = [];
		$this->candidate = [];
		
	}
	public function run()
	{
		$this->candidate = $this->countFrequency($this->candidate);
		$this->candidate = $this->removeInfrequent($this->candidate);

		// Are we done?
		if (count($this->candidate) <= 0)
		{
			return $this;
		}

		//Add to results and start new iteration
		$this->result[] = array_values($this->candidate);



		// Join for the first iteration.
		$temp = [];

		foreach ($this->result[0] as $index => $itemsetOne)
		{
			for ($i = $index+1; $i < count($this->result[0]); $i++)
			{
				$temp[] = new Itemset([
					$itemsetOne->get(0),
					$this->result[0][$i]->get(0)
				]);
			}
		}

		$temp = $this->countFrequency($temp);
		$temp = $this->removeInfrequent($temp);

		// Are we done?
		if (count($temp) <= 0)
		{
			return $this;
		}

		$itteration = 2;

		while (count($temp) > 0)
		{

			//Add to results and start new iteration
			$this->result[] = array_values($temp);

			$temp = $this->join($this->result[$itteration - 1]);

			//Prune
			$temp = $this->prune($this->result[$itteration - 1], $temp);

			$temp = $this->countFrequency($temp);

			$temp = $this->removeInfrequent($temp);			

			$itteration++;			
		}

		return $this;

	}

	public function get()
	{
		return $this->result;
	}
	public function prune($previous, $current)
	{
		$result = [];

		foreach ($current as $curItemset)
		{
			$subsets = $curItemset->getSubsets();

			$itemsetIsValid = true;

			foreach ($subsets as $subset)
			{
				$subsetIsValid = false;

				foreach ($previous as $preItemset)
				{
					if (Itemset::equal($preItemset, $subset))
						{
							$subsetIsValid = true;
							break;
						}
					}

					if (!$subsetIsValid)
					{
						$itemsetIsValid = false;
						break;
					}

				}

				if ($itemsetIsValid)
				{
					$result[] = $curItemset;
				}
			}

			return $result;

		}
		private function join($set)
		{
			$result = [];

			foreach ($set as $index => $itemset)
			{

				$match = false;
				$pointer = $index;

				do {

					$pointer++;

				// Check if the pointer is too far ahead
					if ($pointer >= count($set))
					{
						break;
					}

					if ($itemset->canJoin($set[$pointer]))
					{
						$result[] = Itemset::join($itemset, $set[$pointer]);
						$match = true;
					}

				} while ($match);

			}

			return $result;
		}

		private function countFrequency($candidate)
		{
		// Count frequecy of the alphabet in the database
			foreach ($this->database as $transaction)
			{
				$xact = $transaction->getItemset();

				foreach ($candidate as $itemset)
				{
					if($this->compare($xact, $itemset))
					{
						$itemset->addSupport();
					}
				}
			}

			return $candidate;
		}

		private function removeInfrequent($candidate)
		{
		//Remove non-frequent itemsets
			foreach ($candidate as $index => $itemset)
			{
				if (!$this->isFrequent($itemset))
				{
					unset($candidate[$index]);
				}
			}

			return $candidate;
		}
		private function isFrequent(Itemset $set)
		{
			return $set->getSupport() >= $this->threshold;
		}

		private function compare(Itemset $xact, Itemset $itemset)
		{
		// To chance of a match, if transaction table is smaller.
			if ($xact->size() < $itemset->size())
			{
				return false;
			} 

			$foundFit = false;
			$xactOffset = 0;
			$itemOffset = 0;

			while ($xactOffset < $xact->size() && $itemOffset < $itemset->size())  
			{
				$xactItem = $xact->get($xactOffset);
				$item = $itemset->get($itemOffset);

				if ($xactItem->id() > $item->id())
				{
					return false;
				}
				elseif ($xactItem->id() == $item->id())
				{
					$xactOffset++;
					$itemOffset++;
					$foundFit = true;
				}
				else
				{
					$xactOffset++;
					$foundFit = false;
				}
			}

			if ($itemOffset >= $itemset->size())
			{
				return $foundFit;
			}

			return false;
		}

		public function setThreshold($support)
		{
			$this->threshold = $support;

			return $this;
		}

		public function setDatabase(\Iterator $database)
		{
			$this->database = $database;

			return $this;
		}

		public function setAlphabet($items)
		{
			foreach ($items as $item)
			{
			//No sorting required for itemsets of size one.
				$this->alphabet[] = new Itemset([$item], true);
			}

			$this->candidate = $this->alphabet;

			return $this;
		}

		public static function union($firstSet, $secondSet)
		{
			return array_unique(
				array_merge($firstSet, $secondSet)
			);		
		}
	}

	?>