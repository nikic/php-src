--TEST--
Multiple declarations of the same static variable
--FILE--
<?php

function foo()
{
    static $a = 13;
    static $a = 14;
    var_dump($a);
}
function fn442874985()
{
    $a = 5;
    var_dump($a);
    static $a = 10;
    static $a = 11;
    var_dump($a);
    foo();
}
fn442874985();
--EXPECT--
int(5)
int(11)
int(14)
