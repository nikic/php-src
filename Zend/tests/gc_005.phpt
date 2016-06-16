--TEST--
GC 005: Simple object cycle
--INI--
zend.enable_gc=1
--FILE--
<?php

function fn552611106()
{
    $a = new stdClass();
    $a->a = $a;
    var_dump($a);
    unset($a);
    var_dump(gc_collect_cycles());
    echo "ok\n";
}
fn552611106();
--EXPECTF--
object(stdClass)#%d (1) {
  ["a"]=>
  *RECURSION*
}
int(1)
ok
