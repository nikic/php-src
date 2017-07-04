--TEST--
Foreach loop tests - error case: not an array.
--FILE--
<?php

function fn871949853()
{
    echo "\nNot an array.\n";
    $a = TRUE;
    foreach ($a as $v) {
        var_dump($v);
    }
    $a = null;
    foreach ($a as $v) {
        var_dump($v);
    }
    $a = 1;
    foreach ($a as $v) {
        var_dump($v);
    }
    $a = 1.5;
    foreach ($a as $v) {
        var_dump($v);
    }
    $a = "hello";
    foreach ($a as $v) {
        var_dump($v);
    }
    echo "done.\n";
}
fn871949853();
--EXPECTF--

Not an array.

Warning: Invalid argument supplied for foreach() in %s on line %d

Warning: Invalid argument supplied for foreach() in %s on line %d

Warning: Invalid argument supplied for foreach() in %s on line %d

Warning: Invalid argument supplied for foreach() in %s on line %d

Warning: Invalid argument supplied for foreach() in %s on line %d
done.
