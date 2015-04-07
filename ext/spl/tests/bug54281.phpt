--TEST--
Bug #54281 (Crash in spl_recursive_it_rewind_ex)
--FILE--
<?php

class RecursiveArrayIteratorIterator extends RecursiveIteratorIterator {
	function __construct($it, $max_depth) { }
}
$it = new RecursiveArrayIteratorIterator(new RecursiveArrayIterator(array()), 2);

foreach($it as $k=>$v) { }

?>
--EXPECTF--
LogicException: The object is in an invalid state as the parent constructor was not called in %s on line %d
Stack trace:
#0 %s%ebug54281.php(8): RecursiveIteratorIterator->rewind()
#1 {main}
