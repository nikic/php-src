--TEST--
Defining constants with non-scalar values
--FILE--
<?php

function fn2145605914()
{
    define('foo', new stdClass());
    var_dump(foo);
    define('foo', fopen(__FILE__, 'r'));
    var_dump(foo);
}
fn2145605914();
--EXPECTF--
Warning: Constants may only evaluate to scalar values or arrays in %s on line %d

Notice: Use of undefined constant foo - assumed 'foo' in %s on line %d
string(%d) "foo"
resource(%d) of type (stream)
