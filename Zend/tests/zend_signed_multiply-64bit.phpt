--TEST--
Zend signed multiply 64-bit, variation 1
--SKIPIF--
<?php if ((1 << 31) < 0) print "skip Running on 32-bit target"; ?>
--FILE--
<?php

function fn1973219545()
{
    var_dump(0x80000000 * -0xffffffff);
    var_dump(0x80000001 * 0xfffffffe);
    var_dump(0x80000001 * -0xffffffff);
}
fn1973219545();
--EXPECTF--
int(-9223372034707292160)
int(9223372036854775806)
float(-9.2233720390023E+18)
