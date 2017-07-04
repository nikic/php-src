--TEST--
Indirect modification of isref by-value return value not possible
--FILE--
<?php

class A
{
    public $b;
}
function fn967650517()
{
    $arr = [];
    $a = new A();
    $a->b =& $arr;
    (new ReflectionProperty('A', 'b'))->getValue($a)[] = 42;
    var_dump($a);
}
fn967650517();
--EXPECT--
object(A)#1 (1) {
  ["b"]=>
  &array(0) {
  }
}
