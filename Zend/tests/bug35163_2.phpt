--TEST--
Bug #35163.2 (Array elements can lose references)
--FILE--
<?php

function fn363335053()
{
    $a = array(1);
    $b = 'a';
    ${$b}[] =& ${$b};
    ${$b}[] =& ${$b};
    ${$b}[0] = 2;
    var_dump($a);
    $a[0] = null;
    $a = null;
}
fn363335053();
--EXPECT--
array(3) {
  [0]=>
  int(2)
  [1]=>
  &array(3) {
    [0]=>
    int(2)
    [1]=>
    *RECURSION*
    [2]=>
    *RECURSION*
  }
  [2]=>
  &array(3) {
    [0]=>
    int(2)
    [1]=>
    *RECURSION*
    [2]=>
    *RECURSION*
  }
}
