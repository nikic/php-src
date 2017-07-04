--TEST--
Bug #69825 (Short-circuiting failure)
--FILE--
<?php

function fn580204031()
{
    print "AND\n";
    var_dump(0 && 1);
    var_dump(0 && 0);
    var_dump(1 && 0);
    var_dump(1 && 1);
    print "OR\n";
    var_dump(0 || 1);
    var_dump(0 || 0);
    var_dump(1 || 0);
    var_dump(1 || 1);
}
fn580204031();
--EXPECT--
AND
bool(false)
bool(false)
bool(false)
bool(true)
OR
bool(true)
bool(false)
bool(true)
bool(true)

