--TEST--
GC 009: Unreferenced array-object cycle
--INI--
zend.enable_gc=1
--FILE--
<?php

function fn1306860748()
{
    $a = array();
    $a[0] = new stdClass();
    $a[0]->a = array();
    $a[0]->a[0] =& $a[0];
    var_dump($a[0]);
    var_dump(gc_collect_cycles());
    unset($a);
    var_dump(gc_collect_cycles());
    echo "ok\n";
}
fn1306860748();
--EXPECTF--
object(stdClass)#%d (1) {
  ["a"]=>
  array(1) {
    [0]=>
    *RECURSION*
  }
}
int(0)
int(2)
ok
