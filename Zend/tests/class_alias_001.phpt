--TEST--
Testing class_alias()
--FILE--
<?php

class foo
{
}
function fn1680075983()
{
    class_alias('foo', 'bar');
    $a = new foo();
    $b = new bar();
    var_dump($a == $b, $a === $b);
    var_dump($a instanceof $b);
    var_dump($a instanceof foo);
    var_dump($a instanceof bar);
    var_dump($b instanceof foo);
    var_dump($b instanceof bar);
}
fn1680075983();
--EXPECT--
bool(true)
bool(false)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
