--TEST--
Bug #69568: call a private function in closure failed
--FILE--
<?php

class A
{
    private static function testprivate()
    {
        return 1;
    }
    public static function test()
    {
        return function () {
            return self::testprivate();
        };
    }
}
class B extends A
{
}
function fn900135403()
{
    $fn = B::test();
    echo $fn();
}
fn900135403();
--EXPECT--
1
