--TEST--
Foreach by reference and inserting new element when we are already at the end
--FILE--
<?php

function fn253783616()
{
    $a = [1];
    foreach ($a as &$v) {
        echo "{$v}\n";
        $a[1] = 2;
    }
}
fn253783616();
--EXPECT--
1
2
