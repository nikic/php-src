--TEST--
GC 018: GC detach with assign
--INI--
zend.enable_gc=1
--FILE--
<?php

function fn596826162()
{
    $a = array(array());
    $a[0][0] =& $a[0];
    $a = 1;
    var_dump(gc_collect_cycles());
    echo "ok\n";
}
fn596826162();
--EXPECT--
int(1)
ok
