--TEST--
Test when constants are initialised. See also selfParent_001.phpt.
--FILE--
<?php

class A
{
    const myConst = "const in A";
    const myDynConst = self::myConst;
    public static function test()
    {
        var_dump(self::myDynConst);
    }
}
class B extends A
{
    const myConst = "const in B";
    public static function test()
    {
        var_dump(parent::myDynConst);
    }
}
function fn1672583087()
{
    B::test();
    A::test();
}
fn1672583087();
--EXPECT--
string(10) "const in A"
string(10) "const in A"
