--TEST--
Redeclare inherited protected static property as protected.
--FILE--
<?php

class A
{
    protected static $p = "A::p (static)";
    static function showA()
    {
        echo self::$p . "\n";
    }
}
class B extends A
{
    protected $p = "B::p";
    function showB()
    {
        echo $this->p . "\n";
    }
}
function fn361255513()
{
    A::showA();
    $b = new B();
    $b->showA();
    $b->showB();
}
fn361255513();
--EXPECTF--

Fatal error: Cannot redeclare static A::$p as non static B::$p in %s on line %d

