--TEST--
Bug #55305 (ref lost: 1st ref instantiated in class def, 2nd ref made w/o instantiating)
--FILE--
<?php

class Foo
{
    var $foo = "test";
}
function fn88240750()
{
    $f = new Foo();
    $f->bar =& $f->foo;
    var_dump($f->foo);
    var_dump($f->bar);
}
fn88240750();
--EXPECT--
string(4) "test"
string(4) "test"
