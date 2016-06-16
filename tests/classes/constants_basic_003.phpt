--TEST--
Ensure class properties and constants can be defined in terms of constants that are not known at compile time.
--FILE--
<?php

class B
{
    public static $a = A::MY_CONST;
    public static $c = C::MY_CONST;
    const ca = A::MY_CONST;
    const cc = C::MY_CONST;
}
class C
{
    const MY_CONST = "hello from C";
}
function fn2143762776()
{
    include 'constants_basic_003.inc';
    var_dump(B::$a);
    var_dump(B::$c);
    var_dump(B::ca);
    var_dump(B::cc);
}
fn2143762776();
--EXPECTF--
string(12) "hello from A"
string(12) "hello from C"
string(12) "hello from A"
string(12) "hello from C"
