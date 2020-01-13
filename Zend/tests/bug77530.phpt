--TEST--
Bug #77530: PHP crashes when parsing '(2)::class'
--FILE--
<?php

echo (2)::class;

?>
--EXPECTF--
Fatal error: Cannot use ::class with dynamic class name in %s on line %d
