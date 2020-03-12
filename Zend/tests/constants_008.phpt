--TEST--
Defining constant twice with two different forms
--FILE--
<?php

define('a', 2);
const a = 1;


if (defined('a')) {
    print a;
}

?>
--EXPECTF--
Fatal error: Constant a already defined in %s on line %d
