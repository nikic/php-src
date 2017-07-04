--TEST--
Constexpr arrays should be able to handle resource keys
--FILE--
<?php

const FOO = [STDIN => 42];
function fn348343552()
{
    var_dump(FOO);
}
fn348343552();
--EXPECTF--
Notice: Resource ID#%d used as offset, casting to integer (%d) in %s on line %d
array(1) {
  [%d]=>
  int(42)
}
