--TEST--
Bug #40705 (Iterating within function moves original array pointer)
--FILE--
<?php

function doForeach($array)
{
    foreach ($array as $k => $v) {
        // do stuff
    
    }
}
function fn1777801795()
{
    $foo = array('foo', 'bar', 'baz');
    var_dump(key($foo));
    doForeach($foo);
    var_dump(key($foo));
    foreach ($foo as $k => $v) {
        var_dump($k);
    }
    var_dump(key($foo));
}
fn1777801795();
--EXPECT--
int(0)
int(0)
int(0)
int(1)
int(2)
int(0)
