--TEST--
Redeclare inherited public static property as protected static.
--FILE--
<?php

class A
{
    public static $p = "A::p (static)";
    static function showA()
    {
        echo self::$p . "\n";
    }
}
class B extends A
{
    protected static $p = "B::p (static)";
    static function showB()
    {
        echo self::$p . "\n";
    }
}
function fn2098154236()
{
    A::showA();
    B::showA();
    B::showB();
}
fn2098154236();
--EXPECTF--

Fatal error: Access level to B::$p must be public (as in class A) in %s on line %d

