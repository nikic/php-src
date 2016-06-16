--TEST--
Bug #69376 (Wrong ref counting)
--FILE--
<?php

function &test()
{
    $var = array();
    $var[] =& $var;
    return $var;
}
function fn551351153()
{
    $a = test();
    $b = $a;
    $b[0] = 123;
    print_r($a);
    print_r($b);
}
fn551351153();
--EXPECT--
Array
(
    [0] => 123
)
Array
(
    [0] => 123
)
