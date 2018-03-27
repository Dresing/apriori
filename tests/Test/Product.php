<?php 


namespace Apriori\Test;


use Apriori\Item;

class Product implements Item
{

	private $id;
	public $name;

	function __construct($id, $name)
	{
		$this->id = $id;
		$this->name = $name;
	}

	/**
	*	Item implementation
	*/
	public function id(): int
	{
		return $this->id;
	}

	public static function generate($amount = 100)
	{
		for ($i = 0; $i < $amount; $i++)
		{
			$products[] = new Product($i);
		}

		return $products;
	}
}

 ?>