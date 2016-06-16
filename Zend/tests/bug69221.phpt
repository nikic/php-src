--TEST--
Bug #69221: Segmentation fault when using a generator in combination with an Iterator
--FILE--
<?php

function gen()
{
    (yield 1);
}
function fn1911755730()
{
    $gen1 = gen();
    $gen2 = (object) $gen1;
    foreach ($gen1 as $v1) {
        foreach ($gen2 as $v2) {
            break 2;
        }
    }
    unset($gen1);
    foreach ($gen2 as $v) {
        var_dump($v);
    }
}
fn1911755730();
--EXPECTF--
int(1)
