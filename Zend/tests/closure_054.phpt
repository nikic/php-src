--TEST--
Closure 054: self::class in non-static closure in non-static method.

--FILE--
<?php

class A
{
    function foo()
    {
        $f = function () {
            return self::class;
        };
        return $f();
    }
}
class B extends A
{
}
function fn672019006()
{
    $b = new B();
    var_dump($b->foo());
}
fn672019006();
--EXPECT--
string(1) "A"
