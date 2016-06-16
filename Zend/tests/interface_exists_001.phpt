--TEST--
Testing interface_exists()
--FILE--
<?php

interface foo
{
}
function fn411526977()
{
    var_dump(interface_exists('foo'));
    var_dump(interface_exists(1));
    var_dump(interface_exists(NULL));
    var_dump(interface_exists(new stdClass()));
}
fn411526977();
--EXPECTF--
bool(true)
bool(false)
bool(false)

Warning: interface_exists() expects parameter 1 to be string, object given in %s on line %d
NULL
