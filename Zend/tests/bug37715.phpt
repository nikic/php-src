--TEST--
Bug #37715 (array pointers resetting on copy)
--FILE--
<?php

function fn1334162319()
{
    $a = array('a' => array('A', 'B', 'C', 'D'), 'b' => array('AA', 'BB', 'CC', 'DD'));
    // Set the pointer of $a to 'b' and the pointer of 'b' to 'CC'
    reset($a);
    next($a);
    next($a['b']);
    next($a['b']);
    next($a['b']);
    var_dump(key($a['b']));
    foreach ($a as $k => $d) {
    }
    // Alternatively $c = $a; and foreachloop removal will cause identical results.
    var_dump(key($a['b']));
}
fn1334162319();
--EXPECT--
int(3)
int(3)
