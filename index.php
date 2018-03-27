<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Apriori\Apriori;
use Apriori\Database;
use Apriori\Item;
use Apriori\Itemset;
use Apriori\Test\Product;
use Apriori\Transaction;

require 'vendor/autoload.php';
require 'data.php';

function dd($data)
{
	echo highlight_string("<?php\n" . var_export($data, true) . ";\n");	
	exit();
}


$db = new Database($xacts);

$letters = ['A','B','C','D','E','F','G','H','I','J','K','L'];

for ($i = 0; $i < 12; $i++)
{
	$alphabet[] = new Product($i, $letters[$i]);
}

$A = (new Apriori())
	->setDatabase($db)
	->setAlphabet($alphabet)
	->setThreshold(4)
	->run()
	->get();

dd($A);


	









 ?>