--TEST--
Subtract 3 variables and print result
--FILE--
<?php

function fn698452804()
{
    $a = 27;
    $b = 7;
    $c = 10;
    $d = $a - $b - $c;
    echo $d;
}
fn698452804();
--EXPECT--
10
