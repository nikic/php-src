--TEST--
empty() on array elements
--FILE--
<?php

function fn1523323009()
{
    $a = array('0', 'empty' => '0');
    var_dump(empty($a['empty']));
    var_dump(empty($a[0]));
    $b = '0';
    var_dump(empty($b));
}
fn1523323009();
--EXPECT--
bool(true)
bool(true)
bool(true)
