--TEST--
Bug #45910 (Cannot declare self-referencing constant)
--FILE--
<?php

class foo
{
    const AAA = 'x';
    const BBB = 'a';
    const CCC = 'a';
    const DDD = self::AAA;
    private static $foo = array(self::BBB => 'a', self::CCC => 'b', self::DDD => self::AAA);
    public static function test()
    {
        self::$foo;
    }
}
function fn748619869()
{
    foo::test();
    print 1;
}
fn748619869();
--EXPECT--
1
