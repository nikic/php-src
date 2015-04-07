--TEST--
SplDoublyLinkedList::offsetGet() with 1st parameter passed as string.
--CREDITS--
PHPNW Test Fest 2009 - Jordan Hatch
--FILE--
<?php

$array = new SplDoublyLinkedList( );

$get = $array->offsetGet( 'fail' );

?>
--EXPECTF--
OutOfRangeException: Offset invalid or out of range in %s on line %d
Stack trace:
#0 %s
#1 {main}