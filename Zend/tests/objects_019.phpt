--TEST--
Testing references of dynamic properties
--FILE--
<?php

function fn1981583247()
{
    error_reporting(E_ALL);
    $foo = array(new stdclass(), new stdclass());
    $foo[1]->a =& $foo[0]->a;
    $foo[0]->a = 2;
    $x = $foo[1]->a;
    $x = 'foo';
    var_dump($foo, $x);
}
fn1981583247();
--EXPECT--
array(2) {
  [0]=>
  object(stdClass)#1 (1) {
    ["a"]=>
    &int(2)
  }
  [1]=>
  object(stdClass)#2 (1) {
    ["a"]=>
    &int(2)
  }
}
string(3) "foo"
