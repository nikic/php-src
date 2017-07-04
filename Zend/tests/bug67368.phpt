--TEST--
Bug #67368 (Memory leak with immediately dereferenced array in class constant)
--INI--
report_memleaks=1
--FILE--
<?php

class FooBar
{
    const bar = ["bar" => 3]["bar"];
}
function fn1777117951()
{
    echo "okey";
}
fn1777117951();
--EXPECTF--
okey
