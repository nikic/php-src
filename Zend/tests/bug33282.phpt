--TEST--
Bug #33282 (Re-assignment by reference does not clear the is_ref flag)
--FILE--
<?php

function fn590815478()
{
    $a = array(1, 2, 3);
    $r =& $a[0];
    $r =& $a[1];
    $r =& $a[2];
    var_dump($a);
}
fn590815478();
--EXPECT--	
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  &int(3)
}
