<?php 

use Apriori\Itemset;
use Apriori\Test\Product;
use Apriori\Transaction;


// First Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(1, 'B'),
		new Product(4, 'E'),
		new Product(6, 'G'),
		new Product(7, 'H'),
	])	
));

// Second Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(0, 'A'),
		new Product(1, 'B'),
		new Product(2, 'C'),
		new Product(4, 'E'),
		new Product(6, 'G'),
		new Product(7, 'H'),
	])
));

//Third Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(0, 'A'),
		new Product(1, 'B'),
		new Product(2, 'C'),
		new Product(4, 'E'),
		new Product(5, 'F'),
		new Product(7, 'H'),
	])
));

//Fourth Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(1, 'B'),
		new Product(2, 'C'),
		new Product(3, 'D'),
		new Product(4, 'E'),
		new Product(5, 'F'),
		new Product(6, 'G'),
		new Product(7, 'H'),
		new Product(11,'L'),
	])	
));

//Fifth Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(0, 'A'),
		new Product(1, 'B'),
		new Product(4, 'E'),
		new Product(7, 'H'),
		new Product(10,'K'),
	])	
));

//Sixth Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(1, 'B'),
		new Product(4, 'E'),
		new Product(5, 'F'),
		new Product(6, 'G'),
		new Product(7, 'H'),
		new Product(8, 'I'),
		new Product(10,'K'),
	])
));

//Seventh Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(0, 'A'),
		new Product(1, 'B'),
		new Product(3, 'D'),
		new Product(6, 'G'),
		new Product(7, 'H'),
	])
));

//Eigth Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(0, 'A'),
		new Product(1, 'B'),
		new Product(3, 'D'),
		new Product(6, 'G'),
	])	
));

//Ninth Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(1, 'B'),
		new Product(3, 'D'),
		new Product(5, 'F'),
		new Product(6, 'G'),
	])
));

//Tenth Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(2, 'C'),
		new Product(4, 'E'),
		new Product(5, 'F'),
	])	
));


//Eleventh Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(0, 'A'),
		new Product(2, 'C'),
		new Product(4, 'E'),
		new Product(5, 'F'),
		new Product(7, 'H'),
	])	
));

//Twelth Xact

$xacts[] = (new Transaction(
	new Itemset([
		new Product(0, 'A'),
		new Product(1, 'B'),
		new Product(4, 'E'),
		new Product(6, 'G'),
	])	
));

 ?>