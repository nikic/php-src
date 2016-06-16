--TEST--
ORing strings
--FILE--
<?php

function fn653126381()
{
    $s = "123";
    $s1 = "test";
    $s2 = "45345some";
    $s |= 22;
    var_dump($s);
    $s1 |= 11;
    var_dump($s1);
    $s2 |= 33;
    var_dump($s2);
    echo "Done\n";
}
fn653126381();
--EXPECTF--
int(127)

Warning: A non-numeric value encountered in %s on line %d
int(11)

Notice: A non well formed numeric value encountered in %s on line %d
int(45345)
Done
