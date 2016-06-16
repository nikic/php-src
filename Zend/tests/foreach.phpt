--TEST--
foreach() by-ref bug
--FILE--
<?php

function fn980924651()
{
    $foo = array(1, 2, 3, 4);
    foreach ($foo as $key => &$val) {
        if ($val == 3) {
            $foo[$key] = 0;
        } else {
            $val++;
        }
    }
    var_dump($foo);
}
fn980924651();
--EXPECT--	
array(4) {
  [0]=>
  int(2)
  [1]=>
  int(3)
  [2]=>
  int(0)
  [3]=>
  &int(5)
}
