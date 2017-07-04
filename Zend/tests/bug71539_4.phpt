--TEST--
Bug #71539.4 (Memory error on $arr[$a] =& $arr[$b] if RHS rehashes)
--FILE--
<?php

function fn1659062233()
{
    $array = [0 => []];
    $array[0][0] =& $array[0][''];
    $array[0][0] = 42;
    var_dump($array);
}
fn1659062233();
--EXPECT--
array(1) {
  [0]=>
  array(2) {
    [""]=>
    &int(42)
    [0]=>
    &int(42)
  }
}
